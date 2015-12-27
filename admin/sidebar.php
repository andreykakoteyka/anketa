<md-sidenav class="md-sidenav-left md-primary md-raised" md-component-id="left" md-is-locked-open="$mdMedia('gt-md')" >

    <md-toolbar class="md-hue-2" hide-gt-md ng-controller="AdminSidebarController">
        <div class="md-toolbar-tools">
            <h1><md-icon class="material-icons md-raised">school</md-icon> Меню</h1>
            <span flex></span>
            <md-button class="md-icon-button ui-corner-right" aria-label="Sidebar" ng-click="toggleLeftMenu()">
                <md-icon class="material-icons">menu</md-icon>
            </md-button>
        </div>
    </md-toolbar>
    <md-content ng-controller="AdminSidebarController">
        <ul class="sidebar-items">
            <li ng-repeat="menuItem in menuItems"  ui-sref-active="active"><a ui-sref="{{menuItem.state}}" href="{{menuItem.href}}"><md-icon class="material-icons md-raised">{{menuItem.icon}}</md-icon><span> {{menuItem.name}}</span></a></li>
            <!--li><a  href="#/db"><md-icon class="material-icons md-raised">storage</md-icon> База</a></li>
            <li><a  href="#/management"><md-icon class="material-icons md-raised">developer_board</md-icon> Управление</a></li>
            <li><a  href="#/settings"><md-icon class="material-icons md-raised">settings</md-icon> Настройки</a></li-->
        </ul>
    </md-content>
</md-sidenav>