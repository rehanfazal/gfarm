<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?php echo e(asset('images/logo.png')); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    GFarm
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="<?php echo e(asset('assets/css/material-dashboard.css?v=2.1.2')); ?>" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?php echo e(asset('assets/demo/demo.css')); ?>" rel="stylesheet" />
</head>

<body class="vh-100">
  <!-- Main navigation -->
<div class="container-fluid mt-3 mb-5">
  
  <!-- Full Page Intro -->
  <section style="background-image: url('https://mdbootstrap.com/img/Photos/Others/images/90.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
    <!-- Mask & flexbox options-->
    <div class="mask d-flex justify-content-center align-items-center">
      <!-- Content -->
      <div class="container py-5 my-5">
        
        <!-- <h3 class="font-weight-bold text-center white-text pb-2 white">Get Started Free</h3>
        <p class="lead text-center white-text pt-2 mb-5">Start to explore our product absolutely free.</p> -->
        <div class="row text-center" align="center">
	        <img src="<?php echo e(asset('images/logo.png')); ?>" class=" img-fluid" width="200px" height="200px" style="border-radius: 50%; margin-left:40%">
	    </div>
        <!--Grid row-->
        <div class="row d-flex align-items-center justify-content-center">
          <!--Grid column-->
          <div class="col-md-6 col-xl-5">
            <!--Form-->
            <form action="<?php echo e(route('login-authenticate')); ?>" method="post">
            	<?php echo csrf_field(); ?>
	            <div class="card">
	              <div class="card-body z-depth-2 px-4">
	                <div class="md-form">
	                  <i class="fa fa-envelope prefix grey-text"></i>
	                  <input type="text" id="form2" class="form-control" name="email">
	                  <label for="form2">Your email</label>
	                </div>
	                <div class="md-form">
	                  <i class="fas fa-key prefix grey-text"></i>
	                  <input type="password" id="form4" class="form-control" name="password">
	                  <label for="form4">Your password</label>
	                </div>
	                <div class="text-center my-3">
	                  <button class="btn btn-indigo btn-block">Login</button>
	                </div>
	              </div>
	            </div>
        	</form>
            <!--/.Form-->
          </div>
          <!--Grid column-->
        </div>
        <!--Grid row-->
      </div>
      <!-- Content -->
    </div>
    <!-- Mask & flexbox options-->
  </section>
  <!-- Full Page Intro -->
  
</div>
<!-- Main navigation -->
</body>

</html><?php /**PATH E:\xampp\htdocs\gfarm\resources\views/login.blade.php ENDPATH**/ ?>