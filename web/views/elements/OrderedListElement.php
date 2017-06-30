<?php
namespace seven_recipe\views\elements;
use seven_recipe\views\helpers\ListItemsHelper;

/**
 * Class OrderedListElement
 * @package seven_recipe\views\elements
 *
 * Creates HTML for an ordered list, given some information
 * about the data to present
 */
class OrderedListElement {

    /**
     * Creates a string of HTML code to make an ordered list of the given data, which can
     * be described with the given data name
     * @param $dataName String name of the data (to put above the ordered list in a paragraph tag)
     * @param $data String Array<String> all the data to list out
     * @return bool|string false if dataName or data are not properly configured, or else the HTML for the list
     */
    public function render($dataName, $data) {
        if(!isset($dataName) || !is_string($dataName)) {
            return false;
        }
        if(!isset($data) || !is_array($data)) {
            return false;
        }
        $listHTML = "    <p>" . htmlspecialchars($dataName) . "</p>\n<ol>";
        $lih = new ListItemsHelper();
        $listHTML .= $lih->render($data);
        $listHTML .= "</ol>\n";
        return $listHTML;
    }

}