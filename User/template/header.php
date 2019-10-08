<?php
  $strSQL = "SELECT * FROM member WHERE m_uname = '".$_SESSION['UserID']."' ";
  $objQuery = mysqli_query($link,$strSQL);
  $objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<body>
  <header>
    <!-- Navbar
    ================================================== -->
    <div class="cbp-af-header">
      <div class=" cbp-af-inner">
        <div class="container">
          <div class="row">

            <div class="span4">
              <!-- logo -->
              <div class="logo">
                <h1><a href="index.php">Plato</a></h1>
                <!-- <img src="assets/img/logo.png" alt="" /> -->
              </div>
              <!-- end logo -->
            </div>

            <div class="span8">
              <!-- top menu -->
              <div class="navbar">
                <div class="navbar-inner">
                  <nav>
                    <ul class="nav topnav">
                      <li class="dropdown active">
                        <a href="index.php">เอกสารทั้งหมด</a>
                      </li>
                      <li class="dropdown">
                        <a href="#">การตอบรับเอกสาร</a>
                      </li>
                      <li class="dropdown">
                        <a href="#">ดาวน์โหลดเอกสาร</a>
                      </li>
                      <li class="dropdown">
                        <a href="#">ค้นเอกสารย้อนหลัง</a>
                      </li>
                      <li class="dropdown">
                        <a href="#"><i class="icon-user"></i> <?php echo $objResult["m_uname"]; ?> </a>
                        <ul class="dropdown-menu">
                          <li><a href="#">โปร์ไฟล์</a></li>
                          <li><a href="logout.php">ออกจากระบบ</a></li>
                        </ul>
                      </li>
                      <!-- <li class="dropdown">
                        <a href="#">Pages</a>
                        <ul class="dropdown-menu">
                          <li><a href="about.html">About us</a></li>
                          <li><a href="pricingtable.html">Pricing table</a></li>
                          <li><a href="fullwidth.html">Fullwidth</a></li>
                          <li><a href="404.html">404</a></li>
                        </ul>
                      </li>
                      <li class="dropdown">
                        <a href="#">Portfolio</a>
                        <ul class="dropdown-menu">
                          <li><a href="portfolio-2cols.html">Portfolio 2 columns</a></li>
                          <li><a href="portfolio-3cols.html">Portfolio 3 columns</a></li>
                          <li><a href="portfolio-4cols.html">Portfolio 4 columns</a></li>
                          <li><a href="portfolio-detail.html">Portfolio detail</a></li>
                        </ul>
                      </li>
                      <li class="dropdown">
                        <a href="#">Blog</a>
                        <ul class="dropdown-menu">
                          <li><a href="blog_left_sidebar.html">Blog left sidebar</a></li>
                          <li><a href="blog_right_sidebar.html">Blog right sidebar</a></li>
                          <li><a href="post_left_sidebar.html">Post left sidebar</a></li>
                          <li><a href="post_right_sidebar.html">Post right sidebar</a></li>
                        </ul>
                      </li>
                      <li>
                        <a href="contact.html">Contact</a>
                      </li> -->
                    </ul>
                  </nav>
                </div>
              </div>
              <!-- end menu -->
            </div>

          </div>
        </div>
      </div>
    </div>
  </header>

  <script src="assets/js/jquery.js"></script>
  <script src="assets/js/modernizr.js"></script>
  <script src="assets/js/jquery.easing.1.3.js"></script>
  <script src="assets/js/google-code-prettify/prettify.js"></script>
  <script src="assets/js/bootstrap.js"></script>
  <script src="assets/js/jquery.prettyPhoto.js"></script>
  <script src="assets/js/portfolio/jquery.quicksand.js"></script>
  <script src="assets/js/portfolio/setting.js"></script>
  <script src="assets/js/hover/jquery-hover-effect.js"></script>
  <script src="assets/js/jquery.flexslider.js"></script>
  <script src="assets/js/classie.js"></script>
  <script src="assets/js/cbpAnimatedHeader.min.js"></script>
  <script src="assets/js/jquery.refineslide.js"></script>
  <script src="assets/js/jquery.ui.totop.js"></script>

  <!-- Template Custom Javascript File -->
  <script src="assets/js/custom.js"></script>

</body>

</html>
