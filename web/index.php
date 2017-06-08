<?php
// Require Composer's autoload file (to autoload included vendors)
require_once("../vendor/autoload.php");

//Code to get PDO connection to Heroku Database
$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => 'php://stderr',
));

// Register view rendering
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/',
));

// Set up database PDO
$dbopts = parse_url(getenv('DATABASE_URL'));
$app->register(new Csanquer\Silex\PdoServiceProvider\Provider\PDOServiceProvider('pdo'),
               array(
                'pdo.server' => array(
                   'driver'   => 'pgsql',
                   'user' => $dbopts["user"],
                   'password' => $dbopts["pass"],
                   'host' => $dbopts["host"],
                   'port' => $dbopts["port"],
                   'dbname' => ltrim($dbopts["path"],'/')
                   )
               )
);

// Implement autoloader for seven_recipe's files
spl_autoload_register(function ($className) {
    // all files are in web or root folder, which makes it the prefixes
    $prefixes = ['web/', ''];

    foreach($prefixes as $prefix) {
        // then directory of class (since all classes in this website have namespaces
        //   seven_recipe\...  in folders named ...) we do some string manipulation
        //   to extract the proper directory to jump to for requiring the class
        //   (replacing backslash with forward slash, and only include name of class
        //   starting after seven_recipe\ in namespace to get file directory of the class)
        $dir = str_replace('\\', '/', substr($className, strpos($className, "seven_recipe\\") + strlen("seven_recipe\\"))) . '.php';

        // combine prefix and directory to pick out file to require
        if(file_exists("$prefix$dir")) {
            require_once("$prefix$dir");
        }
    }
});

// Our web handler for the landing page
$app->get('/', function(\Symfony\Component\HttpFoundation\Request $request) use($app) {
    $app['monolog']->addDebug('logging output.');
    //echo "<!-- " . strval($request) . " -->\n";
    $request->overrideGlobals();
    echo "<!-- ";
    print_r($_REQUEST);
    echo " -->\n";
    $lc = new seven_recipe\controllers\LandingController();
    $lc->callView();
    // Make a new Controller to determine what page to show to user
    //$controller = new \seven_recipe\controllers\Controller();  // Must use fully qualified name so Controller successfully used
    //$controller->processForms();
    return "";
    //return "<!-- Comment returned --><!DOCTYPE html><html lang=\"en\"><head><title>Seven Recipe</title></head><body><p>Seven Recipe</p></body></html>";
    //return $app['twig']->render('index.php');
});


$app->run();


