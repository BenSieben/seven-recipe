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
     * @param $pdo PDO reference to database that holds recipes relation
     * @return mixed false if statement failed, or else gives back query results
     */
    public function getAllRecipes($pdo) {
        $statement = $pdo->prepare("SELECT * FROM recipes");
        $statement->execute();

        $result = $statement->get_result();
        return $result;
    }

}