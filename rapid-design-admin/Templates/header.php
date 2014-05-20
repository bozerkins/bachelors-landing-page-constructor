<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=$title; ?></title>

    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <!-- Custom theme CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
	
	<!-- Customer CSS index -->
	<link rel="stylesheet" href="<?=$base_script_url; ?>css/index.css">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	  <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#" id="rapid-design-logo">Rapid Design</a>
        </div>
        <p class="navbar-text navbar-right">Greetings <a href="#" class="navbar-link">Bogdans Ozerkins</a>!</p>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar" id="main-menu">
		<?php foreach($menu as $group) : ?>
			<ul class="nav nav-sidebar">
			<?php foreach($group as $title => $link) : ?>
				<li <?=($title === $menuItem) ? 'class="active"' : ''; ?>><a href="<?=$base_url . $link; ?>"><?=$title; ?></a></li>
			<?php endforeach; ?>
			</ul>
		<?php endforeach; ?>
        </div>
		  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">