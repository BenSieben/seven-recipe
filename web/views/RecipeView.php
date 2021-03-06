<?php
namespace seven_recipe\views;
use seven_recipe\views\elements\OrderedListElement;
use seven_recipe\views\elements\UnorderedListElement;

/**
 * Class RecipeView
 * @package seven_recipe\views
 *
 * View for showing a recipe
 */
class RecipeView extends View {

    /**
     * Renders HTML for recipe pages on the website
     * @param Array $data Array<String> data to prepare the web page
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
        <h1><a href="<?= $data['url'] ?>">Seven Recipe</a></h1>
        <?php
        if($data['errorFound'] === true) {  // Means query to get recipe information failed
            echo "<h2>An error occurred while trying to find the recipe &quot;" .
                $data['recipeSearchName'] . "&quot;. Please make sure the recipe name is valid</h2>";
        }
        else {  // Means query to get recipe information succeeded
            echo "
            <h2>Name&colon; <em>" . $data['name'] . "</em></h2>
            <h3>Category&colon; <em>" . $data['category'] . "</em></h3>
            <h3>Description&colon; <em>" . $data['description'] . "</em></h3>
            <h4>Date Submitted&colon; <em>" . $data['date_submitted'] . "</em></h4>";
            //Use some Element classes to generate lists for ingredients / instructions
            $ule = new UnorderedListElement();
            echo $ule->render('Ingredients', $data['ingredients']);

            $ole = new OrderedListElement();
            echo $ole->render('Instructions', $data['instructions']);
        }
        ?>
        </body>
        </html>
        <?php
    }
}