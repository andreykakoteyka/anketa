<html>
<body>
<head>
    <title><?php get_title(); ?></title>
    <script type="text/javascript" src="bower_components/angular/angular.min.js"></script>
    <link rel="stylesheet" href="bower_components/angular-material/angular-material.min.css">

    <link rel="stylesheet" href=" css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">

</head>
<body ng-app='app'>
<header>
    <md-toolbar class="md-primary md-raised md-hue-2" layout="row" layout-wrap>
        <div layout-fill layout="row">
            <md-button id="brand" md-no-ink ng-href="/" aria-label="Brand"><md-icon class="md-raised md-primary md-icon"  md-svg-icon="brand"></md-icon></md-button>
            <!--md-icon class="md-primary" md-svg-icon="android"></md-icon-->
            <div class="title" flex layout="row" layout-align="center center">
                <div flex="none" class="md-display-2" id="title">
                    <?php get_title(); ?>
                </div>
            </div>
        </div>
    </md-toolbar>
</header>