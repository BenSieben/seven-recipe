<?php
namespace seven_recipe\views;
use seven_recipe\views\elements\RecipeTableElement;

/**
 * Class LandingView
 * @package seven_recipe\views
 */
class LandingView extends View {

    /**
     * Should render a HTML page, using $data for certain
     * parameters of the web page
     * @param $data Array<String> data to use to prepare the web page
     */
    public function render($data)
    {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seven Recipe</title>
    <link rel="icon" href="<?= $data['url'] ?>/images/favicon.ico" />
    <link rel="stylesheet" href="<?= $data['url'] ?>/stylesheets/main.css" />
</head>
<body>
    <h1>Seven Recipe</h1>
    <h2>Recipe Search</h2>
    <form name="recipeSearchForm" action="" method="get">
        <label>Filter by recipe name:
            <input type="text" name="recipeSearch" placeholder="Recipe name (or portion of recipe name)" size="40"/>
        </label>
        <br />
        <label>Filter by a category:
            <select name="categorySelect" title="Category Selection">
                <option>Category 1</option>
                <option>Category 2</option>
                <option>Category 3</option>
            </select>
        </label>
        <br />
        <input type="submit" value="Filter results" />
    </form>
<?php
    $rte = new RecipeTableElement();
    echo $rte->render($data['recipeAttributes'], $data['recipes']);
?>
</body>
</html>
<?php
    }
}
?>