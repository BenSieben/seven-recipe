<?php
namespace seven_recipe\views\helpers;

/**
 * Class Helper
 * @package seven_recipe\views\helpers
 *
 * Helpers are used to help out the view and / or element components
 * of the website to iterate through arrays of data
 * and produce HTML to show to the user
 */
abstract class Helper {
    /**
     * Method that should iterate through given data and make some HTML
     * code of it to use in a view
     * @param $data Array to iterate through
     * @return String HTML code to display the data
     */
    public abstract function render($data);
}