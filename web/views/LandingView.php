<?php
namespace seven_recipe\views;

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
    <title>Website</title>
</head>
<body>
<p>Test website</p>
</body>
</html>
<?php
    }
}
?>