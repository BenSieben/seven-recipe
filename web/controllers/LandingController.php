<?php
namespace seven_recipe\controllers;
use seven_recipe\views\LandingView;
use seven_recipe\configs\Config;

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
        $data = $this->setUpViewData();
        $view->render($data);
    }

    /**
     * Sets up an array of data that the landing view needs to be set up
     * @return array data that the landing view needs to create the web page
     */
    private function setUpViewData() {
        $data = [];

        //Add base url to
        $data['url'] = Config::BASE_URL;

        return $data;
    }

}
?>