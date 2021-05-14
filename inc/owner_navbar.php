        <!--navbar-->
        <nav class="navbar fixed-top navbar-expand-lg bg-dark navbar-dark bg-primary">
          <a class="navbar-brand" href="../owner/index.php">
            خليج مول للتجارة
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="../owner/index.php"><i class="fas fa-home"></i><span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../owner/profile.php"><i class="fas fa-user"></i></a>
              </li>


              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="../owner/supplier.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-users"></i>  
                الموردين
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="../owner/supplier.php?do=add">اضافة مورد</a>
                  <a class="dropdown-item" href="../owner/supplier.php">عرض الموردين</a>
                  <!-- <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Something else here</a> -->
                </div>
              </li>
              
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="../owner/products.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fab fa-product-hunt"></i>  
                المنتجات
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="../owner/products.php?do=add">اضافة منتج</a>
                  <a class="dropdown-item" href="../owner/products.php">عرض المنتجات</a>
                  <!-- <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Something else here</a> -->
                </div>
              </li> 

              <li class="nav-item">
                <a class="nav-link" href="../owner/orders.php"><i class="fas fa-shopping-cart"></i> الطلبات </a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt"></i> تسجيل خروج </a>
              </li>
              
            </ul>
            
          </div>
        </nav>
        <!--end navbar-->