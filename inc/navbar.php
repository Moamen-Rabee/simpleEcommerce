        <!--navbar-->
        <nav class="navbar fixed-top navbar-expand-lg bg-dark navbar-dark bg-primary">
          <a class="navbar-brand" href="../user/userHome.php">
            خليج مول للتجارة
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="../user/userHome.php"><i class="fas fa-home"></i>الرئيسية<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../user/profile.php"><i class="fas fa-user"></i>الصفحة الشخصية</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../user/cart.php"><i class="fas fa-shopping-cart"></i>عربة التسوق</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt"></i>تسجيل خروج</a>
              </li>
              <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li> -->
            </ul>
            <form class="form-inline my-2 my-lg-0" method="get" action="view_products.php">
              <input class="form-control mr-sm-2" type="search" name="search_word" placeholder="بحث فى المنتجات" aria-label="Search">
              <button class="btn btn-outline-info btn_search_nav my-2 my-sm-0" type="submit">بحث</button>
            </form>
          </div>
        </nav>
        <!--end navbar-->