<!DOCTYPE html>
<html lang="en">

<?php echo $this->extend('templates/header'); ?>
<?php echo $this->section('content'); ?>
<style>
.bookmark-post .favorite-icon a, .job-box.bookmark-post .favorite-icon a {
    background-color: #da3746;
    color: #fff;
    border-color: danger;
}
.favorite-icon a {
    display: inline-block;
    width: 30px;
    height: 30px;
    font-size: 18px;
    line-height: 30px;
    text-align: center;
    border: 1px solid #eff0f2;
    border-radius: 6px;
    color: rgba(173,181,189,.55);
    -webkit-transition: all .5s ease;
    transition: all .5s ease;
}


.candidate-list-box .favorite-icon {
    position: absolute;
    right: 22px;
    top: 22px;
}
.fs-14 {
    font-size: 14px;
}
</style>    
<body>
  <div class="container-scroller d-flex">
    <!-- partial:./partials/_sidebar.html -->
   <?php echo $this->include('templates/menu');?>
    <!-- partial -->
    <div class="page-body-wrapper">
      <!-- partial:./partials/_navbar.html -->
     <?php echo $this->include('templates/navbar');?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 col-xl-12 grid-margin stretch-card">
              <div class="row w-100 flex-grow">
                <div class="col-md-4 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-head bg-primary">
                        กำลังดำเนินการ
                    </div>
                    <div class="card-body">
                  <div class="candidate-list">
                    <div class="candidate-list-box card mt-2">
                        <div class="p-2 card-body">
                            <div class="align-items-center row">
                                <!-- <div class="col-auto">
                                    <div class="candidate-list-images">
                                        <a href="#"><img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="avatar-md img-thumbnail rounded-circle" /></a>
                                    </div>
                                </div> -->
                                <div class="col-lg-5">
                                    <div class="candidate-list-content mt-3 mt-lg-0">
                                        <h5 class="fs-19 mb-0">
                                            <a class="primary-link" href="#">Charles Dickens</a><span class="badge bg-success ms-1"><i class="mdi mdi-star align-middle"></i>4.8</span>
                                        </h5>
                                        <p class="text-muted mb-2">Project Manager</p>
                                        <ul class="list-inline mb-0 text-muted">
                                            <li class="list-inline-item"><i class="mdi mdi-map-marker"></i> Oakridge Lane Richardson</li>
                                            <li class="list-inline-item"><i class="mdi mdi-wallet"></i> $650 / hours</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mt-2 mt-lg-0 d-flex flex-wrap align-items-start gap-1">
                                        <span class="badge bg-soft-secondary fs-14 mt-1">Leader</span><span class="badge bg-soft-secondary fs-14 mt-1">Manager</span><span class="badge bg-soft-secondary fs-14 mt-1">Developer</span>
                                    </div>
                                </div>
                            </div>
                            <div class="favorite-icon">
                                <a href="#"><i class="mdi mdi-heart fs-18"></i></a>
                            </div>
                        </div>
                    </div> 
                </div>
                </div>
            <!-- row end -->
            </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card text-white">
                  <div class="card">
                    <div class="card-head bg-primary">
                        รออนุมัติ
                    </div>
                    <div class="card-body">
                  <div class="candidate-list">
                    <div class="candidate-list-box card mt-2">
                        <div class="p-2 card-body">
                            <div class="align-items-center row">
                                <!-- <div class="col-auto">
                                    <div class="candidate-list-images">
                                        <a href="#"><img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="avatar-md img-thumbnail rounded-circle" /></a>
                                    </div>
                                </div> -->
                                <div class="col-lg-5">
                                    <div class="candidate-list-content mt-3 mt-lg-0">
                                        <h5 class="fs-19 mb-0">
                                            <a class="primary-link" href="#">Charles Dickens</a><span class="badge bg-success ms-1"><i class="mdi mdi-star align-middle"></i>4.8</span>
                                        </h5>
                                        <p class="text-muted mb-2">Project Manager</p>
                                        <ul class="list-inline mb-0 text-muted">
                                            <li class="list-inline-item"><i class="mdi mdi-map-marker"></i> Oakridge Lane Richardson</li>
                                            <li class="list-inline-item"><i class="mdi mdi-wallet"></i> $650 / hours</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mt-2 mt-lg-0 d-flex flex-wrap align-items-start gap-1">
                                        <span class="badge bg-soft-secondary fs-14 mt-1">Leader</span><span class="badge bg-soft-secondary fs-14 mt-1">Manager</span><span class="badge bg-soft-secondary fs-14 mt-1">Developer</span>
                                    </div>
                                </div>
                            </div>
                            <div class="favorite-icon">
                                <a href="#"><i class="mdi mdi-heart fs-18"></i></a>
                            </div>
                        </div>
                    </div> 
                </div>
                </div>
            <!-- row end -->
            </div>
            </div>

            <div class="col-md-4 grid-margin stretch-card text-white">
                  <div class="card">
                    <div class="card-head bg-primary">
                        อนุมัติเสร็จสิ้น
                    </div>
                    <div class="card-body">
                  <div class="candidate-list">
                    <div class="candidate-list-box card mt-2">
                        <div class="p-2 card-body">
                            <div class="align-items-center row">
                                <!-- <div class="col-auto">
                                    <div class="candidate-list-images">
                                        <a href="#"><img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="avatar-md img-thumbnail rounded-circle" /></a>
                                    </div>
                                </div> -->
                                <div class="col-lg-5">
                                    <div class="candidate-list-content mt-3 mt-lg-0">
                                        <h5 class="fs-19 mb-0">
                                            <a class="primary-link" href="#">Charles Dickens</a><span class="badge bg-success ms-1"><i class="mdi mdi-star align-middle"></i>4.8</span>
                                        </h5>
                                        <p class="text-muted mb-2">Project Manager</p>
                                        <ul class="list-inline mb-0 text-muted">
                                            <li class="list-inline-item"><i class="mdi mdi-map-marker"></i> Oakridge Lane Richardson</li>
                                            <li class="list-inline-item"><i class="mdi mdi-wallet"></i> $650 / hours</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mt-2 mt-lg-0 d-flex flex-wrap align-items-start gap-1">
                                        <span class="badge bg-soft-secondary fs-14 mt-1">Leader</span><span class="badge bg-soft-secondary fs-14 mt-1">Manager</span><span class="badge bg-soft-secondary fs-14 mt-1">Developer</span>
                                    </div>
                                </div>
                            </div>
                            <div class="favorite-icon">
                                <a href="#"><i class="mdi mdi-heart fs-18"></i></a>
                            </div>
                        </div>
                    </div> 
                </div>
                </div>
            <!-- row end -->
            </div>
            </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  </div>
      <!-- main-panel ends -->
      <?php echo $this->include('templates/footer');?>
    </div>
    <!-- page-body-wrapper ends -->
    
  </div>

        <!-- content-wrapper ends -->
        <!-- partial:./partials/_footer.html -->
         
        <!-- partial -->
      
  <?php $this->endSection();?>
</body>

</html>