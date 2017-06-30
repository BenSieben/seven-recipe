<?php
namespace seven_recipe\views\helpers;

/**
 * Class ListItemsHelper
 * @package seven_recipe\views\helpers
 *
 * Helper which can go through a given array of items,
 * making the HTML code for show the array as a list
 * (does NOT include outer tag that defines what type of list will be shown)
 */
class ListItemsHelper extends Helper {

    /**
     * Renders a HTML list's contents (i.e., li tag) to display the contents of a given set of data
     * @param Array $data Array<String> data to list out
     * @return String|false HTML code of table for all items in $data, or false if $data
     * is not a valid array
     */
    public function render($data) {
        if(!isset($data) || !is_array($data)) {
            return false;
        }
        $listContentHTML = "";
        foreach($data as $element) {
            $listContentHTML .= "        <li>" . htmlspecialchars($element) . "</li>\n";
        }
        return $listContentHTML;
    }

}