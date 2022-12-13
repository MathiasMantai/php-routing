<?php

$routes = array(
    array(
        'path_pattern' => '/^index$/',
        'controller'   => 'controller/IndexController.php'
    ),
    array(
        'path_pattern' => '/^user\/(?P<user_id>\d+)$/',
        'controller'   => 'controller/UserController.php'
    ),
);


function router($routes)
{
    $route_match = false;
    $url_path    = 'index';
    $url_params  = array();
    
    if(isset($_GET['path'])) {
        $url_path = $_GET['path'];
        if(substr($url_path,-1) == '/')
        {
        $url_path = substr($url_path,0,-1);
        }
    }
    
    foreach($routes as $route) {
        if(preg_match($route['path_pattern'],$url_path,$matches))
        {
        $url_params  = array_merge($url_params,$matches);
        $route_match = true;
        break;
        }
    }
    
    if(!$route_match) {
        exit('Undefined Path.');
    }
    
    if(file_exists($route['controller'])) {
        include($route['controller']);
    }
    else {
        exit('Controller does not exist.');
    }
}

router($routes);

?>