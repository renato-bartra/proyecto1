<body class="hold-transition skin-purple sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="admin-area.php" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>U</b>WC</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>UXWD</b>WebCamp</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php echo $_SESSION["foto"];?>" class="user-image" alt="User Image">
                    <span class="hidden-xs"><?php echo $_SESSION["nombre"]; ?></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <img src="<?php echo $_SESSION["foto"]; ?>" class="img-circle" alt="User Image">
                        <p><?php echo $_SESSION["nombre"]; ?> - Web Developer</p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="#" class="btn bg-purple btn-flat">Ajustes</a>
                        </div>
                        <div class="pull-right">
                            <a href="login.php?cerrar_sesion=true" class="btn btn-danger btn-flat">Cerrar sesión</a>
                        </div>
                    </li>
                </ul>
                </li>
            </ul>
        </div>
      </nav>
    </header>
