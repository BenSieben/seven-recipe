<?php
namespace seven_recipe\controllers;

use seven_recipe\views\LandingView;

/**
 * Class LandingController
 * @package seven_recipe\controllers
 *
 * Controller for landing view of the seven_recipe website
 */
class LandingController extends Controller{

    public function callView() {
        $view = new LandingView();
        $view->render(null);
    }

}
?>