<nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
      <li class="nav-item sidebar-category">
        <p>ยินดีต้อนรับคุณ</p>
          <p> <?php echo $_SESSION["usertbl"]["name"].' '.$_SESSION["usertbl"]["surname"] ?></p>
         
        </li>
        <li class="nav-item sidebar-category">
          <p>Navigation</p>
          <span></span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../">
            <i class="mdi mdi-view-quilt menu-icon"></i>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item sidebar-category">
          <p>Components</p>
          <span></span>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('showjob');?>"> 
            <i class="mdi mdi-view-headline menu-icon"></i>
            <span class="menu-title">หัวข้องาน</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('approvefirstpage');?>">
            <i class="mdi mdi-view-headline menu-icon"></i>
            <span class="menu-title">approve</span>
          </a>
        </li>
        <!-- usermanage -->
        <?php if($_SESSION["usertbl"]["level"] != 'user'){?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('usermanage');?>">
            <i class="mdi mdi-view-headline menu-icon"></i>
            <span class="menu-title">จัดการผู้ใช้</span>
          </a>
        </li>
        <?php }?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('logout');?>">
          &nbsp;&nbsp;<i class="mdi mdi-logout"></i>
            <span class="menu-title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;logout</span>
          </a>
        </li>
       
      </ul>
    </nav>