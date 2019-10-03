<?php
  include("connection/connect.php");
  $sql = "SELECT * FROM member WHERE m_uname = '".$_SESSION['uname']."'";
  $result = mysqli_query($link,$sql);
  if(mysqli_num_rows($result) == 0){
    header("location:pages-error-404.php");
  }else{
    while($mem = mysqli_fetch_assoc($result)){
      $fname = $mem['m_fname'];
      $lname = $mem['m_lname'];
      $uname = $mem['m_uname'];
      $phone = $mem['m_phone'];
      $mail = $mem['m_mail'];
      $pass = $mem['m_pass'];
      $img = $mem['m_profile'];
      $sector = $mem['m_sector'];
      $major = $mem['m_major'];
    }
  }
?>
<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">
                <!-- Logo icon --><b>
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img src="assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                    <!-- Light Logo icon -->
                    <img src="assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                </b>
                <!--End Logo icon -->
                <!-- Logo text --><span>
                 <span style="font-weight: 400;" class="text-info">
                   <!-- dark Logo text -->
                   <b style="font-weight: 900;">E</b>
                   <!-- Light Logo text -->
                   Document
                 </span>

        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="fa fa-bars"></i></a> </li>
                <!-- ============================================================== -->
            </ul>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <ul class="navbar-nav my-lg-0">
                <!-- ============================================================== -->
                <!-- Profile -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown u-pro">
                    <a class="nav-link waves-effect waves-dark profile-pic" href="pages-profile.php"><img src="assets/images/users/<?php if($img == ""){echo 'no_profile.png';}else{echo $img;} ?>" alt="user" /> <span class="hidden-md-down"><?php echo $fname.' '.$lname; ?> &nbsp;</span> </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
