<?php
namespace seven_recipe\controllers;
use seven_recipe\configs\Config as Config;

class Controller {

    /**
     * This function will look at PHP superglobal values to determine
     * what kind of Controller should handle the request
     */
    public function processForms() {
        if(isset($_REQUEST['c'])) { // c is name of Controller to call
            if(strcmp($_REQUEST['c'], 'landing') === 0) { // use LandingController
                $lc = new LandingController();
                $lc->callView();
            }
        }
        else { // if $_REQUEST['c'] is not set, then show default landing page
            header("Location: " . Config::BASE_URL . "?c=landing");
            //Trying out just using the landing controller directly instead of header() - it works
            //$lc = new LandingController();
            //$lc->callView();
        }
    }

}
?>