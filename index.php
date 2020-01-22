<?php
    /*
     * David Kislyak
     * 01/15/2020
     * /328/food/index.php
     */

    // Error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    //Require autoload file
    require("./vendor/autoload.php");

    //Instantiate F3
    $f3 = Base::instance();

    //Define a default route
    $f3->route('GET /', function() {
        $view = new Template();
        echo $view->render('./views/home.html');
    });

    //.htaccess required for routing
    //Define a breakfast route
    $f3->route('GET /breakfast', function() {
        $view = new Template();
        echo $view->render('views/breakfast.html');
    });

    //Define a breakfast/buffet route
    $f3->route('GET /breakfast/buffet', function() {
        $view = new Template();
        echo $view->render('views/breakfast-buffet.html');
    });

    //Define a lunch route
    $f3->route('GET /lunch', function() {
        $view = new Template();
        echo $view->render('views/lunch.html');
    });

    $f3->route('GET /order', function() {
        $view = new Template();
        echo $view->render('views/form1.html');
    });

    //Define a route that accepts a food parameter
    $f3->route('GET /@item', function($f3, $params) {
//        var_dump($params);
        $item  = $params['item'];

        $foodsWeServe = array("tacos", "pizza", "lumpia");
        if (!in_array($item, $foodsWeServe)) {
            echo "<p>Sorry, we don't serve $item</p>";
        } else {

            echo "<p>You ordered $item</p>";
        }

        switch($item) {
            case 'tacos':
                echo "<p>We serve tacos on Tuesday</p>";
                break;
            case 'pizza':
                echo "<p>Pepperoni or veggie?</p>";
                break;
            case 'bagels':
                $f3->reroute("/breakfast");
                break;
            default:
                $f3->error(404);
        }
    });

    //Run fat free
    $f3->run();