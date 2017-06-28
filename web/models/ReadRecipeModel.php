<?php
namespace seven_recipe\models;

/**
 * Class ReadRecipeModel
 * @package seven_recipe\models
 *
 * Model for reading recipes from the database
 * to show to the user
 */
class ReadRecipeModel {

    /**
     * Reads all data in the recipes table, returning the result of executing the statement
     * @param $pdo \PDO reference to database that holds recipes relation
     * @return Array<String> query results
     */
    public function getAllRecipes($pdo) {
        $statement = $pdo->prepare("SELECT * FROM recipes");
        $statement->execute();

        //$result = $statement->fetchAll();
        $result = array();
        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        return $result;
    }

    /**
     * Attempts to read a single recipe from the recipes table, checking for a
     * recipe that has the matching recipe name as the given variable
     * @param $pdo \PDO reference to database that holds recipes relation
     * @param $recipeName String name of recipe to look up
     * @return mixed false if no recipe could be found with matching name, or else give back query results
     */
    public function getRecipe($pdo, $recipeName) {
        $statement = $pdo->prepare("SELECT * FROM recipes WHERE name = ?");
        $statement->bindParam(1, $recipeName, \PDO::PARAM_STR);
        $statement->execute();

        //$result = $statement->fetchAll();
        $result = array();
        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        return $result;
    }

}