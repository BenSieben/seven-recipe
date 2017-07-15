<?php
namespace seven_recipe\views;
use seven_recipe\views\elements\RecipeTableElement;
use seven_recipe\views\helpers\SelectOptionHelper;

/**
 * Class LandingView
 * @package seven_recipe\views
 *
 * View for the landing page of the website
 */
class LandingView extends View {

    /**
     * Renders HTML of the landing page for the website
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
            <input type="text" name="recipeSearch" placeholder="Recipe name (or portion of recipe name)" size="40" value="<?= $data['recipeSearch'] ?>"/>
        </label>
        <br />
        <label>Filter by a category:
            <select name="categorySelect" title="Category Selection">
<?php
                $soh = new SelectOptionHelper($data['categorySelect']);
                echo $soh->render($data['recipeCategories']);
?>
            </select>
        </label>
        <br />
        <input type="submit" value="Filter results" />
    </form>
    <br />
    <h2>Recipe List</h2>
    <br />
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