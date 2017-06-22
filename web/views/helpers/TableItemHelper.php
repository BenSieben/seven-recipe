<?php
namespace seven_recipe\views\helpers;

/**
 * Class TableItemHelper
 * @package seven_recipe\views\helpers
 *
 * Helper to give tbody code for an array of data
 * that needs to be put in HTML table format
 */
class TableItemHelper extends Helper {

    /**
     * Renders a HTML table's contents (i.e., tbody tag) to display the contents of a given set of data
     * @param Array $data Array<Pair('link', 'content')> of data to use to make links
     * to other pages and display content in a table (content is an array of columns to show in a row of the table)
     * @return String|false HTML code of table for all items in $data, or false if  $data
     * is not a valid array
     */
    public function render($data) {
        if(!isset($data) || !is_array($data)) {
            return false;
        }
        $tbodyHTML = "    <tbody>\n";
        foreach($data as $pair) {
            $link = $pair['link'];
            $content = $pair['content'];
            $tbodyHTML .= "         <tr>\n";
            $i = 0;
            foreach($content as $column) {
                if($i === 0) {  // Add link to other page when in first column of the row
                    $tbodyHTML .= "            <td><a href=\"$link\">" . htmlspecialchars($column) . "</a></td>\n";
                }
                else {
                    $tbodyHTML .= "            <td>" . htmlspecialchars($column) . "</td>\n";
                }
                $i++;
            }
            $tbodyHTML .= "        </tr>\n";
        }
        $tbodyHTML .= "    </tbody>\n";
        return $tbodyHTML;
    }
}