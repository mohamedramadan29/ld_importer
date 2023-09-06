<!-- Header -->
<header class="header-v2">
    <!-- Header desktop -->
    <div class="container-menu-desktop trans-03">
        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop p-l-45">
                <!-- Logo desktop -->
                <a href="index" class="logo">
                    <img width="180px !important" src="images/logo.svg" alt="IMG-LOGO">

                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="active-menu">
                            <a href="index">דף הבית </a> <!-- index -->
                        </li>

                        <li>
                            <a href="shop"> כל הדגמים </a> <!-- shop  -->
                        </li>
                        <li>
                            <a href="#"> קטגוריות </a> <!-- category  -->
                            <ul class="sub-menu">
                                <?php
                                $stmt = $connect->prepare("SELECT * FROM categories");
                                $stmt->execute();
                                $allcat = $stmt->fetchAll();
                                foreach ($allcat as $cat) {
                                ?>
                                    <li class="">
                                        <a href="category_models?cat=<?php echo $cat['slug']; ?>">
                                            <?php echo $cat['name']; ?> <i class="fa fa-chevron-right"></i>
                                        </a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </li> 
                        <li>
                            <a href="contact">צור קשר</a> <!-- contact -->
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <img width="180px" src="images/logo.svg" alt="IMG-LOGO">
        </div>
        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="main-menu-m">
            <li>
                <a href="index">דף הבית </a>
            </li> 
            <li>
                <a href="#"> קטגוריות </a> <!-- category  -->
                <ul class="sub-menu-m">
                    <?php
                    $stmt = $connect->prepare("SELECT * FROM categories");
                    $stmt->execute();
                    $allcat = $stmt->fetchAll();
                    foreach ($allcat as $cat) {
                    ?>
                        <li class="">
                            <a href="category_models?cat=<?php echo $cat['slug']; ?>">
                                <?php echo $cat['name']; ?> <i class="fa fa-chevron-right"></i>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
                <span class="arrow-main-menu-m">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </span>
            </li>
            <li>
                <a href="shop"> כל הדגמים </a>
            </li> 

            <li>
                <a href="contact">צור קשר</a>
            </li>
        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="images/icons/icon-close2.png" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Search...">
            </form>
        </div>
    </div>
</header>