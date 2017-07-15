<?php
namespace seven_recipe\models;
use seven_recipe\configs\Config;

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

        //If the category filter is what Config indicates as no selection, we will not use it in query
        $noCategoryFilter = Config::RECIPE_NO_CATEGORY_FILTER;
        if(strcmp($noCategoryFilter, $categoryFilter) == 0) {
            // Set category to empty string if it matches the phrase used to indicate to not filter by category
            $categoryFilter = '';
        }

        // Depending on which variables are "set", we  will do slightly different queries to get the results back
        if(strcmp($nameFilter, '' != 0)) {
            if(strcmp($categoryFilter, '') != 0) {  // Filter by name and category
                $statement = $pdo->prepare("SELECT * FROM recipes WHERE name LIKE ? AND category LIKE ?");
                $statement->bindParam(1, $nameFilter, \PDO::PARAM_STR);
                $statement->bindParam(2, $categoryFilter, \PDO::PARAM_STR);
            }
            else {  // Filter by name only
                $statement = $pdo->prepare("SELECT * FROM recipes WHERE name LIKE ?");
                $statement->bindParam(1, $nameFilter, \PDO::PARAM_STR);
            }
        }
        else if(strcmp($categoryFilter, '') != 0) {  // Filter by category only
            $statement = $pdo->prepare("SELECT * FROM recipes WHERE category LIKE ?");
            $statement->bindParam(1, $categoryFilter, \PDO::PARAM_STR);
        }
        else {  // No filter
            $statement = $pdo->prepare("SELECT * FROM recipes");
        }

        // Execute the statement and return the results in an array
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

        $statement = $pdo->prepare("SELECT * FROM recipes WHERE name = ?");
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