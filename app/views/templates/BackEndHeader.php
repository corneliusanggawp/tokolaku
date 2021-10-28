<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= APPNAME; ?> | Admin <?= $data['pageTitle'] ?></title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= BASEURL; ?>/backend/imgs/theme/favicon.svg">
    <!-- Template CSS -->
    <link href="<?= BASEURL; ?>/backend/css/main.css" rel="stylesheet" type="text/css" />
    <!-- Croppie -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
</head>

<body>
    <div class="screen-overlay"></div>
    <aside class="navbar-aside" id="offcanvas_aside">
        <div class="aside-top">
            <a href="<?= BASEURL; ?>/admin" class="brand-wrap">
                <img src="<?= BASEURL; ?>/backend/imgs/theme/logo.svg" class="logo" alt="TokoLaku Dashboard">
            </a>
            <div>
                <button class="btn btn-icon btn-aside-minimize"> <i class="text-muted material-icons md-menu_open"></i> </button>
            </div>
        </div>
        <nav>
            <ul class="menu-aside">
                <li class="menu-item <?= $data['menuDashboard'] ?>">
                    <a class="menu-link" href="<?= BASEURL; ?>/admin"> <i class="icon material-icons md-home"></i>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                <li class="menu-item <?= $data['menuProduct'] ?>">
                    <a class="menu-link" href="<?= BASEURL; ?>/admin/product"> <i class="icon material-icons md-shopping_bag"></i>
                        <span class="text">Produk</span>
                    </a>
                </li>
                <?php if ($_SESSION['AdminLogin']['role_id'] == 1): ?>
                    <li class="menu-item <?= $data['menuCategory'] ?>">
                        <a class="menu-link" href="<?= BASEURL; ?>/admin/categories"><i class="icon material-icons md-category"></i>
                            <span class="text">Kategori</span>
                        </a>
                    </li>
                <?php endif ?>
                <li class="menu-item <?= $data['menuOrder'] ?>">
                    <a class="menu-link" href="#"> <i class="icon material-icons md-shopping_cart"></i>
                        <span class="text">Order</span>
                    </a>
                </li>
                <li class="menu-item <?= $data['menuSeller'] ?>">
                    <a class="menu-link" href="#"> <i class="icon material-icons md-store"></i>
                        <span class="text">Seller</span>
                    </a>
                </li>
            </ul>
            <?php if ($_SESSION['AdminLogin']['role_id'] == 1): ?>
                <hr>
                <ul class="menu-aside">
                    <li class="menu-item has-submenu <?= $data['menuAccount'] ?>">
                        <a class="menu-link" href="#"> <i class="icon material-icons md-person"></i>
                            <span class="text">Akun</span>
                        </a>
                        <div class="submenu">
                            <a href="#">Member</a>
                            <a href="#">User</a>
                        </div>
                    </li>
                    <li class="menu-item <?= $data['menuSettings'] ?>">
                        <a class="menu-link" href="#"> <i class="icon material-icons md-settings"></i>
                            <span class="text">Pengaturan</span>
                        </a>
                    </li>
                </ul>
            <?php endif ?>
            <br>
            <br>
        </nav>
    </aside>
    <main class="main-wrap">
        <header class="main-header navbar">
            <div class="col-search">
                <form class="searchform">
                    <div class="input-group">
                        <input list="search_terms" type="text" class="form-control" placeholder="Search term">
                        <button class="btn btn-light bg" type="button"> <i class="material-icons md-search"></i></button>
                    </div>
                    <datalist id="search_terms">
                        <option value="Products">
                        <option value="New orders">
                        <option value="Apple iphone">
                        <option value="Ahmed Hassan">
                    </datalist>
                </form>
            </div>
            <div class="col-nav">
                <button class="btn btn-icon btn-mobile me-auto" data-trigger="#offcanvas_aside"> <i class="material-icons md-apps"></i> </button>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link btn-icon darkmode" href="#"> <i class="material-icons md-nights_stay"></i> </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="requestfullscreen nav-link btn-icon"><i class="material-icons md-cast"></i></a>
                    </li>
                    <li class="dropdown nav-item">
                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount" aria-expanded="false"> <img class="img-xs rounded-circle" src="<?= BASEURL; ?>/backend/imgs/people/avatar2.jpg" alt="User"></a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">
                            <a class="dropdown-item" href="#"><i class="material-icons md-perm_identity"></i>Edit Profile</a>
                            <a class="dropdown-item" href="#"><i class="material-icons md-settings"></i>Account Settings</a>
                            <a class="dropdown-item" href="#"><i class="material-icons md-account_balance_wallet"></i>Wallet</a>
                            <a class="dropdown-item" href="#"><i class="material-icons md-receipt"></i>Billing</a>
                            <a class="dropdown-item" href="#"><i class="material-icons md-help_outline"></i>Help center</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="<?= BASEURL; ?>/admin/logout"><i class="material-icons md-exit_to_app"></i>Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </header>