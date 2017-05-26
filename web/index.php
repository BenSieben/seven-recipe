<?php
namespace seven_recipe;

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

/**
 * All links for the website go through this index.php
 */

// Make a new Controller to determine what page to show to user
$controller = new \seven_recipe\controllers\Controller();  // Must use fully qualified name so Controller successfully used
$controller->processForms();

?>