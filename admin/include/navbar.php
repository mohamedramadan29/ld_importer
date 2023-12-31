    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
      </ul>

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="main.php?dir=dashboard&page=dashboard" class="brand-link">
        <span class="brand-text font-weight-light"> Ld Importer </span>
        <!--<img src="uploads/logo.png" alt="AdminLTE Logo" class="brand-image elevation-3" style="box-shadow: none;">-->
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <!-- <img src="uploads/logo.png" class="img-circle elevation-2" alt="User Image"> -->
          </div>
          <div class="info">
            <a href="#" class="d-block"> <?php echo  $_SESSION['admin_username']; ?> </a>
          </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="main.php?dir=dashboard&page=dashboard" class="nav-link">
                <p>
                  الرئيسية
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>
                  الصفحة الرئيسية
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="main.php?dir=banners&page=report" class="nav-link">
                    <p> السلايدر </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="main.php?dir=about_us&page=report" class="nav-link">
                    <p> من نحن </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="main.php?dir=main_banner&page=report" class="nav-link">
                    <p> البانر </p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>
                  الأقسام
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="main.php?dir=categories&page=report" class="nav-link">
                    <p> جميع الأقسام </p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>
                  المنتجات
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="main.php?dir=products&page=report" class="nav-link">
                    <p> جميع المنتجات </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="main.php?dir=products&page=add" class="nav-link">
                    <p> اضافة منتج </p>
                  </a>
                </li>
              </ul>
            </li>
            <!--
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>
                  تصنيف خصائص النبات
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="main.php?dir=product_branches&page=report" class="nav-link">
                    <p> جميع الخصائص </p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>
                  كوبونات الخصم
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="main.php?dir=coupons&page=report" class="nav-link">
                    <p> جميع الكوبونات </p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>
                  الهدايا
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="main.php?dir=gifts&page=report" class="nav-link">
                    <p> جميع الهدايا </p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>
                  الشحن
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="main.php?dir=shipping&page=report" class="nav-link">
                    <p> المناطق </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="main.php?dir=shipping_weight&page=report" class="nav-link">
                    <p> الاحجام </p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>
                  الطلبات
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="main.php?dir=orders&page=add" class="nav-link">
                    <p> اضافة طلب </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="main.php?dir=orders&page=report" class="nav-link">
                    <p> جميع الطلبات </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="main.php?dir=orders&page=archieve" class="nav-link">
                    <p> ارشيف الطلبات </p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>
                  طلبات الأرجاع
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="main.php?dir=returns_order&page=report" class="nav-link">
                    <p> جميع الطلبات </p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>
                  السلات
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="main.php?dir=baskets_uncomplete&page=report" class="nav-link">
                    <p> السلات المتروكة </p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>
                  المدونة 
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="main.php?dir=post_categories&page=report" class="nav-link">
                    <p> الأقسام  </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="main.php?dir=posts&page=report" class="nav-link">
                    <p> التدوينات </p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>
                  الموظفين
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="main.php?dir=employee&page=report" class="nav-link">
                    <p> جميع الموظفين </p>
                  </a>
                </li>
              </ul>
            </li>
              <li class="nav-item">
                  <a href="#" class="nav-link">
                      <p>
                          البانر
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="main.php?dir=banners&page=report" class="nav-link">
                              <p> مشاهدة البانر </p>
                          </a>
                      </li>
                  </ul>
              </li>
            <li class="nav-item">
              <a href="main.php?dir=users&page=report" class="nav-link">
                <p>
                  المستخدمين
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>
                  طلبات ووكومرس
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="main.php?dir=woocommerce&page=report" class="nav-link">
                    <p> جميع الطلبات </p>
                  </a>
                </li>
              </ul>
            </li>
  -->
            <li class="nav-item">
              <a href="logout" class="nav-link" style="color: #e74c3c;">
                <p>
                  تسجيل خروج
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>