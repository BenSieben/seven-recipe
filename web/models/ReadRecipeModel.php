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

        $result = array();
        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        return $result;
    }

    /**
     * Reads recipes from the recipes table which matches the given filters for name and category
     * @param $pdo \PDO reference to database that holds recipes relation to be queried
     * @param $nameFilter String name filter to apply to recipe search (use empty string to not filter by name)
     * @param $categoryFilter String category filter to apply to recipe search (use empty string to not filter by category)
     * @return array|bool false if nameFilter / categoryFilter are not passed to the function, or else array of results
     */
    public function getFilteredRecipes($pdo, $nameFilter, $categoryFilter) {
        if(!isset($nameFilter) || !is_string($nameFilter)) {
            return false;
        }
        if(!isset($categoryFilter) || !is_string($categoryFilter)) {
            return false;
        }

        $statement = $pdo->prepare("SELECT * FROM recipes WHERE name LIKE '%?%' AND category LIKE '%?%'");
        $statement->bindParam(1, $nameFilter, \PDO::PARAM_STR);
        $statement->bindParam(2, $categoryFilter, \PDO::PARAM_STR);
        $statement->execute();

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
        if(!isset($recipeName) || !is_string($recipeName) || strcmp($recipeName, "") == 0) {
            return false;
        }

        $statement = $pdo->prepare("SELECT * FROM recipes WHERE name = '?'");
        $statement->bindParam(1, $recipeName, \PDO::PARAM_STR);
        $statement->execute();

        $result = array();
        $foundResult = false;
        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $result = $row;
            $foundResult = true;
        }
        if(!$foundResult) {
            return $foundResult;
        }
        return $result;
    }

}