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

//Register database code
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
    echo "<!-- ";
    $request->overrideGlobals();
    print_r($_REQUEST);
    echo " -->\n";
    $lc = new seven_recipe\controllers\LandingController($app['pdo']);
    $lc->callView();
    return "";
});

// Web handler for recipe view page
$app->get('/recipe', function(\Symfony\Component\HttpFoundation\Request $request) use($app) {
    $app['monolog']->addDebug('logging output.');
    echo "<!-- ";
    $request->overrideGlobals();
    print_r($_REQUEST);
    echo " -->\n";
    $lc = new seven_recipe\controllers\RecipeController($app['pdo']);
    $lc->callView();
    return "";
});


$app->run();


