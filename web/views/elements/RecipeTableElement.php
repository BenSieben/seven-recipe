<?php
namespace seven_recipe\views\elements;
use seven_recipe\views\helpers\TableItemHelper;

/**
 * Class RecipeTableElement
 * @package seven_recipe\views\elements
 *
 * Creates a full HTML table to show contents of the
 */
class RecipeTableElement {

    /**
     * Constructs HTML table code to display a table based on given header and data
     * @param $header Array of strings (Column Headers) to use in the table's thead
     * @param $data Array<Pair('link', 'content')> to create links to other pages
     * and content to place in rows of the tbody
     * @return string|false HTML code for a table that has sthe given header and content in it, or false if
     * $header / $data are not proper types
     */
    public function render($header, $data) {
        if(!isset($data) || !is_array($data)) {
            return false;
        }
        if(!isset($header) || !is_array($header)) {
            return false;
        }
        $tableHTML = "    <table>\n";
        $tableHTML .= "        <thead><tr>\n";
        foreach($header as $h) {
            $tableHTML .= "            <th>$h</th>";
        }
        $tableHTML .= "        </tr></thead>\n";
        $tih = new TableItemHelper();
        $tableHTML .= $tih->render($data);
        $tableHTML .= "    </table>\n";
        return $tableHTML;
    }

}