<?php
$rules = array( 
    'clubs'   => "/clubs-(?'page'\d+)",    // '/clubs.php-clubID'
    'album'     => "/album/(?'album'[\w\-]+)",              // '/album/album-slug'
    'club-profile'  => "/club-(?'id'\d+)",        // '/category/category-slug'
    'page'      => "/page/(?'page'about|contact)",          // '/page/about', '/page/contact'
    'home'      => "/"                                      // '/'
);

error_reporting(-1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$uri = rtrim( dirname($_SERVER["SCRIPT_NAME"]), '/' );
$uri = '/' . trim( str_replace( $uri, '', $_SERVER['REQUEST_URI'] ), '/' );
$uri = urldecode( $uri );

foreach ( $rules as $action => $rule ) {
    if ( preg_match( '~^'.$rule.'$~i', $uri, $params ) ) {
        /* now you know the action and parameters so you can 
         * include appropriate template file ( or proceed in some other way )
         */
		 if($action == 'home') {
			 header('Location: index.php');
		 }
		 include($action . '.php');
		 
		 
		 exit();
    }
}

include('404.php');
?>