<!DOCTYPE html>
<html lang="en">
<head>
 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <title><?php echo $page_title; ?></title>
	
	
	
	
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
 
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- our custom CSS -->
    <link rel="stylesheet" href="libs/css/custom.css" />

<style>
/* navbar */
.navbar-default {
    background-color: #0000FF;
    border-color: #E7E7E7;
}
/* Title */
.navbar-default .navbar-brand {
    color: #FFFFFF;
}
.navbar-default .navbar-brand:hover,
.navbar-default .navbar-brand:focus {
    color:  #FFFFFF;
}
/* Link */
.navbar-default .navbar-nav > li > a {
    color:  #FFFFFF;
}
.navbar-default .navbar-nav > li > a:hover,
.navbar-default .navbar-nav > li > a:focus {
    color: #FFFFFF;
}
.navbar-default .navbar-nav > .active > a,
.navbar-default .navbar-nav > .active > a:hover,
.navbar-default .navbar-nav > .active > a:focus {
    color: #FFFFFF;
    background-color: #0000FF;
}
.navbar-default .navbar-nav > .open > a,
.navbar-default .navbar-nav > .open > a:hover,
.navbar-default .navbar-nav > .open > a:focus {
    color: #FFFFFF;
    background-color: #D5D5D5;
}
/* Caret */
.navbar-default .navbar-nav > .dropdown > a .caret {
    border-top-color:#FFFFFF;
    border-bottom-color: #FFFFFF;
}
.navbar-default .navbar-nav > .dropdown > a:hover .caret,
.navbar-default .navbar-nav > .dropdown > a:focus .caret {
    border-top-color: #333;
    border-bottom-color: #333;
}
.navbar-default .navbar-nav > .open > a .caret,
.navbar-default .navbar-nav > .open > a:hover .caret,
.navbar-default .navbar-nav > .open > a:focus .caret {
    border-top-color: #555;
    border-bottom-color: #555;
}
/* Mobile version */
.navbar-default .navbar-toggle {
    border-color: #DDD;
}
.navbar-default .navbar-toggle:hover,
.navbar-default .navbar-toggle:focus {
    background-color: #DDD;
}
.navbar-default .navbar-toggle .icon-bar {
    background-color: #CCC;
}
</style>
</head>
<body>
 
    <!-- container -->
    <div class="container" >
      
        <?php
		 include_once 'navigation1.php';

        // show page header
        echo "<div class='page-header'>
                <p style='color:blue; font-family:calibri light; text-align:center; font-size:26px;'>{$page_title}</p>
            </div>";
        ?>