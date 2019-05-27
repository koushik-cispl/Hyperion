<?php
$userPermission = \Helpers::checkRolePermissions();
?>
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="{{ Request::path() == 'admin/dashboard' ? 'active' : '' }}">
                    <a href="{{url('/admin/dashboard')}}"><i class="menu-icon fa fa-laptop"></i>Dashboard</a>
                </li>
                <?php if($userPermission == 1) { ?>
                <li class="{{ Request::path() == 'admin/users' ? 'active' : '' }}{{ Request::path() == 'admin/new-user' ? 'active' : '' }}{{ Request::segment(2) == 'edit-user' ? 'active' : '' }}{{ Request::segment(2) == 'view-user' ? 'active' : '' }}">
                    <a href="{{url('/admin/users')}}"><i class="menu-icon fa fa-users"></i>Users </a>
                </li>
                <?php } ?>
                <?php if($userPermission == 1) { ?>
                <li class="{{ Request::segment(2) == 'crm' ? 'active' : '' }}">
                    <a href="{{url('/admin/crm')}}"><i class="menu-icon fa fa-lock"></i>CRM </a>
                </li>
                <?php } ?>
                <li class="{{ Request::segment(2) == 'prospects' ? 'active' : '' }}">
                    <a href="{{url('/admin/prospects')}}"><i class="menu-icon fa fa-list"></i>Prospects </a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>