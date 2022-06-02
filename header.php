<div class="page-wrapper legacy-theme bg1 toggled border-radius-on">
    <nav id="sidebar" class="sidebar-wrapper">
        <div class="sidebar-content">
            <div class="sidebar-item sidebar-brand">
                <a href=".">Сервис-центр</a>
            </div>
            <div class="sidebar-item sidebar-header d-flex flex-nowrap">
                <div class="user-pic">
                    <img class="img-responsive img-rounded" <?php print('src="'. $user['avatar'].'"'); ?> alt="User picture">
                </div>
                <div class="user-info">
                    <span class="user-name">
                        <strong><?php print($user['name']); ?></strong>
                    </span>
                    <span class="user-role"><?php print($user['role']); ?></span>
                    <span class="user-status">
                        <i class="fa fa-circle"></i>
                        <span>Online</span>
                    </span>
                </div>
            </div>
            <div class=" sidebar-item sidebar-menu">
                <ul>
                    <li class="header-menu">
                        <span>Основное</span>
                    </li>
                    <li class="sidebar-item" style="border-top:none;">
                        <a href=".">
                            <i class="fa fa-tachometer-alt"></i>
                            <span class="menu-text">Главная</span>
                            
                        </a>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="menu-text">Заказы</span>
                           <!--  <span class="badge badge-pill badge-danger">3</span> -->
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="index.php?page=newtask">Добавить новый</a>
                                </li>
                                <li>
                                    <a href="index.php?page=managetask">Управление заказами</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="far fa-gem"></i>
                            <span class="menu-text">Комплектующие</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="index.php?page=neworder">Сделать заказ</a>
                                </li> 
                                <li>
                                    <a href="index.php?page=takeorder">Принять заказ</a>
                                </li>
                                <li>
                                    <a href="index.php?page=manageorder">Склад</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                     <li class="sidebar-item" style="border-top:none;">
                        <a href="index.php?page=report">
                            <i class="fa fa-chart-line"></i>
                            <span class="menu-text">Отчеты</span>
                            
                        </a>
                    </li>
                    <li class="header-menu">
                        <span>Дополнительно</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="sidebar-footer">
            <div>
                <a href="exit.php">
                    <i class="fa fa-power-off"> </i> Выход
                </a>
            </div>
            <div class="pinned-footer">
                <a href="#">
                    <i class="fas fa-ellipsis-h"></i>
                </a>
            </div>
        </div>
    </nav>

    <!--  -->
    <main class="page-content">
        <div id="overlay" class="overlay"></div>
        <nav class="navbar navbar-expand-lg navbar-light sidebar-item border-bottom" style="border-color:rgba(50,50,50,.6);padding-bottom: 9px;position: fixed;width: 100%;background: rgba(255,255,255,.8);backdrop-filter:blur(10px);z-index: 2;">
            <a class="navbar-brand d-none d-lg-block" style="color:white;">
                <a id="toggle-sidebar" class="btn btn-light border rounded-2">
                    <i class="fas fa-bars"></i>
                </a>
              </a>
            <a class="navbar-brand d-none d-lg-block" style="color:white;">
                <a id="toggle-dark" class="btn btn-light border rounded-2">
                    <i class="fas fa-moon"></i>
                </a>
              </a>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link btn-sm btn-light border rounded-2 ml-4" href=".">Главная <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-sm btn-light border rounded-2 ml-1" href="index.php?page=newtask"><i class="fas fa-plus"></i> Новый заказ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-sm btn-light border rounded-2 ml-1" href="index.php?page=neworder"><i class="fas fa-tags"></i> Запросить товар</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="mb-5"></div>
