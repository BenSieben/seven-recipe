<?php
namespace seven_recipe\controllers;
use seven_recipe\views\RecipeView;
use seven_recipe\models\ReadRecipeModel;
use seven_recipe\configs\Config;

/**
 * Class RecipeController
 * @package seven_recipe\controllers
 *
 * Controller for recipe view of the seven_recipe website
 */
class RecipeController {

    private $pdo;  // PDO to allow access to the recipe database

    /**
     * Constructs a new RecipeController
     * @param $pdo \PDO reference to database that has recipes relation
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Looks at PHP super globals to set up data
     * to pass to the recipe view
     */
    public function callView() {
        $view = new RecipeView();
        $data = $this->setUpViewData();
        $view->render($data);
    }

    /**
     * Sets up an array of data that the landing view needs to be set up
     * @return array data that the landing view needs to create the web page
     */
    private function setUpViewData() {
        $data = [];

        //Fetch recipe name to look up from super globals
        $data['recipeSearchName'] = "";
        if(isset($_REQUEST['recipeSearchName'])) {
            $data['recipeSearchName'] = $_REQUEST['recipeSearchName'];
        }

        //Add base url to data
        $data['url'] = Config::BASE_URL;

        //Use ReadRecipeModel to get data from recipes relation
        $readRecipeModel = new ReadRecipeModel();
        $result = $readRecipeModel->getRecipe($this->pdo, $data['recipeSearchName']);
        if($result !== false) {
            $data['errorFound'] = false;
            $data['name'] = htmlspecialchars($result['name']);
            $data['category'] = htmlspecialchars($result['category']);
            $data['description'] = htmlspecialchars($result['description']);
            $data['ingredients'] = explode("\n", $result['ingredients']);
            $data['instructions'] = explode("\n", $result['instructions']);
            $data['date_submitted'] = htmlspecialchars($result['date_submitted']);
        }
        else {
            $data['errorFound'] = true;
        }

        return $data;
    }

}