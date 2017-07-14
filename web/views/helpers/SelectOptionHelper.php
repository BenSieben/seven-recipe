<?php
namespace seven_recipe\views\helpers;

/**
 * Class SelectOptionHelper
 * @package seven_recipe\views\helpers
 *
 * Helper for view to create HTML code for
 * options in a select HTML element
 */
class SelectOptionHelper extends Helper {

    private $optionToSelect;  // Used to keep track of option to select passed to constructor

    /**
     * Constructs a SelectOptionHelper
     * @param $optionToSelect String name of option to mark as selected amongst options (for render() method) - optional
     */
    public function __construct($optionToSelect) {
        $this->optionToSelect = $optionToSelect;
    }

    /**
     * Returns the current option to select in the rendered options (in render method)
     * @return String current option to select in rendered options (in render method)
     */
    public function getOptionToSelect() {
        return $this->optionToSelect;
    }

    /**
     * Changes the option to select in the rendered options to the argument String
     * @param $optionToSelect String new option to select in the rendered options
     */
    public function setOptionsToSelect($optionToSelect) {
        $this->optionToSelect = $optionToSelect;
    }

    /**
     * Iterates through given array of data to generate HTML option code for each
     * element in the array
     * @param $data Array all options to list out
     * @return String HTML code to display the option data
     */
    public function render($data) {
        if(!isset($data) || !is_array($data)) {
            return false;
        }
        $optionHTML = "";
        foreach($data as $opt) {
            if(strcmp($opt, $this->optionToSelect) == 0) {  // Found option to mark as selected
                $optionHTML .= "                <option selected=\"selected\">$opt</option>\n";
            }
            else {  // Do a regular option (not selected)
                $optionHTML .= "                <option>$opt</option>\n";
            }
        }
        return $optionHTML;
    }
}