<div id="header-fix" class="header fixed-top">
    <nav class="navbar navbar-expand-lg  p-0">
        <div class="navbar-header h4 mb-0 align-self-center d-flex navbar_header">  
            <a href="./" class="horizontal-logo align-self-center d-flex d-lg-none logo_cls">
                <img src="../assets/images/<?php echo $SETTING['image'];?>" alt="logo" width="200" class="img-fluid">
            </a>
            <a href="javascript:void(0)" class="sidebarCollapse ml-2 collapse_btn" id="collapse"><i class="icon-menu body-color"></i></a>
        </div>
        <div class="navbar-right ml-auto">
            <ul class="ml-auto p-0 m-0 list-unstyled d-flex">
                <li class="dropdown align-self-center mr-1 d-inline-block">
                    <a href="javascript:void(0)" class="nav-link px-2 notificaton_icon" data-toggle="dropdown" aria-expanded="false"><i class="icon-bell h4"></i>
                        <span class="badge badge-default"> <span class="ring">
                            </span><span class="ring-point">
                            </span> </span>
                    </a>
                </li>
                <li class="dropdown user-profile d-inline-block py-1 mr-2">
                    <a href="#" class="nav-link px-2 py-0" data-toggle="dropdown" aria-expanded="false"> 
                        <div class="media">
                            <div class="media-body align-self-center d-none d-sm-block mr-2">
                                <p class="mb-0 text-uppercase line-height-1"><b><?php echo $_SESSION['ADMIN']['name'];?></b><br/><span> Admin </span></p>
                            </div>
                            <img src="dist/images/admin_1.png" alt="" class="d-flex img-fluid rounded-circle admin_icon" width="60">

                        </div>
                    </a>

                    <div class="dropdown-menu  dropdown-menu-right p-0">
                        <a href="change_password.php" class="dropdown-item px-2 align-self-center d-flex">
                            <span class="icon-pencil mr-2 h6 mb-0"></span> Change Password</a>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-divider"></div>
                        <a href="logout.php" class="dropdown-item px-2 text-danger align-self-center d-flex">
                            <span class="icon-logout mr-2 h6  mb-0"></span> Sign Out</a>
                    </div>

                </li>

            </ul>
        </div>
    </nav>
</div>