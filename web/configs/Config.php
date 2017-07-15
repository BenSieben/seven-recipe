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
    const RECIPE_ATTRIBUTES = ["Name", "Category", "Description", "Ingredients", "Instructions", "Date Submitted"];

    // Array of all the categories for recipes
    const RECIPE_CATEGORIES = [
        "Appetizer / Starter", "Bread / Roll / Muffin", "Bean / Grain / Legume", "Burger", "Cake / Cupcake",
        "Candy / Sweet", "Casserole / Gratin", "Cocktail", "Cookie", "Dessert", "Dip / Spread", "Dressing",
        "Marinade / Rub", "Nonalcoholic Drink", "Pasta / Noodles", "Pie / Tart", "Pizza", "Pudding / Custard",
        "Salad", "Sandwich", "Sauce / Condiment", "Side Dish", "Soup / Stew", "Stuffing", "Other",
    ];

    // String to represent the option from user to not apply category filter to their search
    const RECIPE_NO_CATEGORY_FILTER = "No Filter";
}
?>