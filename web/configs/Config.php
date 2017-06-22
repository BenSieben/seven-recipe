<?php
namespace seven_recipe\configs;

/**
 * Class Config
 * @package seven_recipe\configs
 *
 * Holds values for basic information, such as base URL
 * of the website
 */
class Config {

    const BASE_URL = "https://seven-recipe.herokuapp.com";  // URL to the website on Heroku

    // Array of all the attributes in the recipes relation
    const RECIPE_ATTRIBUTES = ["Name", "Category", "Ingredients", "Instructions", "Date Submitted"];
}
?>