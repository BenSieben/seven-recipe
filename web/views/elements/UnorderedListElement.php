<?php
namespace seven_recipe\views\elements;

/**
 * Class OrderedListElement
 * @package seven_recipe\views\elements
 *
 * Creates HTML for an unordered list, given some information
 * about the data to present
 */
class UnorderedListElement {

    /**
     * Creates a string of HTML code to make an unordered list of the given data, which can
     * be described with the given data name
     * @param $dataName String name of the data (to put above the unordered list in a paragraph tag)
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
        $listHTML = "    <p>" . htmlspecialchars($dataName) . "</p>\n<ul>";
        $lih = new ListItemsHelper();
        $listHTML .= $lih->render($data);
        $listHTML .= "</ul>\n";
        return $listHTML;
    }

}