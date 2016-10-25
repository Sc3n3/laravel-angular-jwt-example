<!DOCTYPE html>
<html lang="en" ng-app="FileboxApp">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Filebox</title>

        <!-- Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,200italic,300,300italic,400italic,600,700,600italic,700italic,900' rel='stylesheet' type='text/css'>
        
        <!-- Styles -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/filebox.css') }}" rel="stylesheet" type="text/css">
        
		<!--[if lt IE 9]>
	    	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	    	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->

    </head>
    <body>
    	<header>
		   	<nav class="navbar navbar-default navbar-fixed-top">
		      <div class="container">
		        <div class="navbar-header">
		          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		            <span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		          </button>
		          <a class="navbar-brand" href="#">#Filebox</a>
		        </div>
		        <div ng-controller="UserController" id="navbar" class="collapse navbar-collapse navbar-right" ng-include="getTemplate('partials/menu_user.html', 'partials/menu_no_user.html')">
		        </div><!--/.nav-collapse -->
		      </div>
		    </nav>
		</header>

        <div class="container" ng-view></div>
        
        <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/angular.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/angular-route.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/filebox.js') }}"></script>
    </body>
</html>
