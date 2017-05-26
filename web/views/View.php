<?php
namespace seven_recipe\views;

/**
 * Class View
 * @package seven_recipe\views
 */
abstract class View {

    /**
     * Should render a HTML page, using $data for certain
     * parameters of the web page
     * @param $data Array<String> data to use to prepare the web page
     */
    public abstract function render($data);
}
?>