<?php
namespace seven_recipe\controllers;
use seven_recipe\views\LandingView;

/**
 * Class LandingController
 * @package seven_recipe\controllers
 *
 * Controller for landing view of the seven_recipe website
 */
class LandingController {

    /**
     * Looks at PHP super globals to set up data
     * to pass to the landing view
     */
    public function callView() {
        $view = new LandingView();
        $view->render(null);
    }

}
?>