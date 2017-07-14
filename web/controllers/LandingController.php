<?php
namespace seven_recipe\controllers;
use seven_recipe\models\ReadRecipeModel;
use seven_recipe\views\LandingView;
use seven_recipe\configs\Config;

/**
 * Class LandingController
 * @package seven_recipe\controllers
 *
 * Controller for landing view of the seven_recipe website
 */
class LandingController {

    private $pdo;  // PDO to allow access to the recipe database

    /**
     * Constructs a new LandingController
     * @param $pdo \PDO reference to database that has reco[es relation
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

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

        //Check for any filtering conditions specified by user
        $data['recipeSearch'] = '';
        if(isset($_REQUEST['recipeSearch'])) {
            $data['recipeSearch'] = html_entity_decode($_REQUEST['recipeSearch']);
        }

        $data['categorySelect'] = '';
        if(isset($_REQUEST['categorySelect'])) {
            $data['categorySelect'] = html_entity_decode($_REQUEST['categorySelect']);
        }

        //Add base url to data
        $data['url'] = Config::BASE_URL;

        //Add headers
        $data['recipeAttributes'] = Config::RECIPE_ATTRIBUTES;

        //Use ReadRecipeModel to get data from recipes relation
        $data['recipes'] = [];
        $readRecipeModel = new ReadRecipeModel();
        //$result = $readRecipeModel->getFilteredRecipes($this->pdo, $data['recipeSearch'], $data['categorySelect']);
        $result = $readRecipeModel->getAllRecipes($this->pdo);
        echo "<!-- result variable value: \n";
        print_r($result);
        echo " -->\n";
        $logStr = "<!-- recipeSearch is " . $data['recipeSearch'] . ", categorySelect is " .
            $data['categorySelect'] . " -->";
        echo $logStr;
        if($result !== false) {
            foreach($result as $row) {
                echo "\n<!-- Row is " . implode("|", $row) . " -->\n";
                $recipeInfo['link'] = Config::BASE_URL . '/recipe?recipeSearchName=' . $row['name'];
                $recipeInfo['content'] = $row;
                array_push($data['recipes'], $recipeInfo);
            }
        }

        return $data;
    }

}
?>