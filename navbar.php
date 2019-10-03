<?php
  $sql = "SELECT * FROM member WHERE m_uname = '".$_SESSION['uname']."'";
  $result = mysqli_query($link,$sql);
  if(mysqli_num_rows($result) > 0){
    while($mem = mysqli_fetch_assoc($result)){
      $status = $mem['m_status'];
    }
  }
?>
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li> <a class="waves-effect waves-dark" href="write.php" aria-expanded="false"><i class="fa fa-plus"></i><span class="hide-menu">เขียน</span></a>
                </li>
                <li> <a class="waves-effect waves-dark" href="index.php" aria-expanded="false"><i class="fa fa-book"></i><span class="hide-menu">ทั้งหมด</span></a>
                </li>
                <?php
                  if($status == '1'){
                    echo '<li> <a class="waves-effect waves-dark" href="list.php" aria-expanded="false"><i class="fa fa-list-alt"></i><span class="hide-menu">บัญชีทั้งหมด</span></a>
                          </li>';
                  }
                ?>
                <li> <a class="waves-effect waves-dark" href="pages-profile.php" aria-expanded="false"><i class="fa fa-address-book"></i><span class="hide-menu">บัญชีของฉัน</span></a>
                </li>
                <li> <a class="waves-effect waves-dark" href="#" data-toggle="modal" data-target="#modal-logout" aria-expanded="false"><i class="fa fa-sign-out"></i><span class="hide-menu">ออกจากระบบ</span></a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<div class="modal fade" id="modal-logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-logout">ข้อความ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ต้องการออกจากระบบหรือไม่
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
        <button type="button" class="btn btn-danger" onclick="window.location.href='logout.php'">ออกจากระบบ</button>
      </div>
    </div>
  </div>
</div>
