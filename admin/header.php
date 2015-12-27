<html>
<head>
    <title><?php get_title();?> | Панель управления</title>
    <script type="text/javascript" src="../bower_components/angular/angular.min.js"></script>
    <link rel="stylesheet" href="../bower_components/angular-material/angular-material.min.css">

    <link rel="stylesheet" href=" css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">

</head>
<body ng-app='admin' ng-controller="AppController">
<header>
    <md-toolbar class="md-primary" layout="row" layout-wrap>
        <div layout="row" class="md-toolbar-tools">
                <div id="brand">
                    <md-icon class="md-raised md-primary md-icon logo"  md-svg-icon="brand"></md-icon>
                    <md-button class="md-icon-button toggleMenu" ng-click="toggleLeftMenu()">
                        <md-icon class="material-icons toggleMenu">menu</md-icon>
                    </md-button>
                </div>

                <!--md-icon class="md-primary" md-svg-icon="android"></md-icon-->
                <div class="title" flex layout="row" layout-align="center center">
                    <div flex="none" class="md-display-2" id="title">
                       Панель управления
                    </div>
                </div>
        </div>
    </md-toolbar>
</header>