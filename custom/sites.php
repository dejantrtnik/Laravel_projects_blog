<?php
//defined('BASEPATH') or exit('No direct script access allowed');

// Define a global basepath
define('BASEPATH', '/');
if ( session_status() == PHP_SESSION_NONE ) {
  session_start();
}



use Routing\Route;
include 'config/Routing/Route.php';
include 'apps/basicApp/root.php';
include 'apps/basicApp/app.php';
root\Modules::basic();
root\BootStyle::basic();
root\Sites::sites();

// Define a global basepath
//define('BASEPATH', '/');

// Add base route (startpage)
Route::add('/', function() {
  navi();
  echo '';
});


Route::add('/about', function() {
  navi();
  echo 'about';
});
//
Route::add('/grid', function() {
  navi();
  echo (new Env('.env'))->dotEnv('db.default.hostname');
});

// Simple test route that simulates static html file
Route::add('/masonry', function() {
  navi();
  echo '
  ';
});

// This example shows how to include files and how to push data to them
Route::add('/blog/([a-z-0-9-]*)', function($slug) {
  navi();
  include('include-example.php');
});

// This route is for debugging only
// It simply prints out some php infos
// Do not use this route on production systems!
Route::add('/phpinfo', function() {
  navi();
  phpinfo();
});

// Get route example
Route::add('/contact-form', function() {
  navi();
  echo '<form method="post">
          <input type="text" name="name">
          <input type="text" name="email">
          <input type="submit" value="send">
        </form>';
}, 'get');

// Post route example
Route::add('/contact-form', function() {
  navi();
  echo 'Hey! The form has been sent:<br>';
  print_r($_POST);
}, 'post');

// Get and Post route example
Route::add('/get-post-sample', function() {
  navi();
	echo 'You can GET this page and also POST this form back to it';
	echo '<form method="post"><input type="text" name="input"><input type="submit" value="send"></form>';
	if (isset($_POST['input'])) {
		echo 'I also received a POST with this data:<br>';
		print_r($_POST);
	}
}, ['get','post']);

// Route with regexp parameter
// Be aware that (.*) will match / (slash) too. For example: /user/foo/bar/edit
// Also users could inject SQL statements or other untrusted data if you use (.*)
// You should better use a saver expression like /user/([0-9]*)/edit or /user/([A-Za-z]*)/edit
Route::add('/user/(.*)/edit', function($id) {
  navi();
  echo 'Edit user with id '.$id.'<br>';
});

// Accept only numbers as parameter. Other characters will result in a 404 error
Route::add('/foo/([0-9]*)/bar', function($var1) {
  navi();
  echo $var1.' is a great number!';
});

// Crazy route with parameters
Route::add('/(.*)/(.*)/(.*)/(.*)', function($var1,$var2,$var3,$var4) {
  navi();
  echo 'This is the first match: '.$var1.' / '.$var2.' / '.$var3.' / '.$var4.'<br>';
});

// Long route example
// By default this route gets never triggered because the route before matches too
Route::add('/foo/bar/foo/bar', function() {
  echo 'This is the second match (This route should only work in multi match mode) <br>';
});

// Route with non english letters: german example
Route::add('/äöü', function() {
  navi();
  echo 'German example. Non english letters should work too <br>';
});

// Route with non english letters: arabic example
Route::add('/الرقص-العربي', function() {
  navi();
  echo 'Arabic example. Non english letters should work too <br>';
});

// Use variables from global scope
// You can use for example use() to inject variables to local scope
// You can use global to register the variable in local scope
$foo = 'foo';
$bar = 'bar';
Route::add('/global/([a-z-0-9-]*)', function($param) use($foo) {
  global $bar;
  navi();
  echo 'The param is '.$param.'<br/>';
  echo 'Foo is '.$foo.'<br/>';
  echo 'Bar is '.$bar.'<br/>';
});

// Return example
// Returned data gets printed
Route::add('/return', function() {
  navi();
  return 'This text gets returned by the add method';
});

// Arrow function example
// Note: You can use this example only if you are on PHP 7.4 or higher
// $bar = 'bar';
// Route::add('/arrow/([a-z-0-9-]*)', fn($foo) => navi().'This is a working arrow function example. <br/> Parameter: '.$foo. ' <br/> Variable from global scope: '.$bar );

// Trailing slash example
Route::add('/aTrailingSlashDoesNotMatter', function() {
  navi();
  echo 'a trailing slash does not matter<br>';
});

// Case example
Route::add('/theCaseDoesNotMatter',function() {
  navi();
  echo 'the case does not matter<br>';
});

// 405 test
Route::add('/this-route-is-defined', function() {
  navi();
  echo 'You need to patch this route to see this content';
}, 'patch');

// Add a 404 not found route
Route::pathNotFound(function($path) {
  // Do not forget to send a status header back to the client
  // The router will not send any headers by default
  // So you will have the full flexibility to handle this case
  header('HTTP/1.0 404 Not Found');
  navi();
  echo 'Error 404 :-(<br>';
  echo 'The requested path "'.$path.'" was not found!';
});

// Add a 405 method not allowed route
Route::methodNotAllowed(function($path, $method) {
  // Do not forget to send a status header back to the client
  // The router will not send any headers by default
  // So you will have the full flexibility to handle this case
  header('HTTP/1.0 405 Method Not Allowed');
  navi();
  echo 'Error 405 :-(<br>';
  echo 'The requested path "'.$path.'" exists. But the request method "'.$method.'" is not allowed on this path!';
});

// Run the Router with the given Basepath
Route::run(BASEPATH);
// Enable case sensitive mode, trailing slashes and multi match mode by setting the params to true
// Route::run(BASEPATH, true, true, true);
?>
