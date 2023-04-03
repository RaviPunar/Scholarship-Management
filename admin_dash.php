<?php
    if(isset($_GET['ftch'])){
                     $fn = $_GET['first_name'];
                     $ln = $_GET['last_name'];
                     $mn = $_GET['mob_num'];
                     $un = $_GET['email'];
                     $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                     $filter = ['fname' => $fn,'lname' => $ln,'mob_num' => $mn,'email' => $un ];
                     $query1 = new MongoDB\Driver\Query($filter);      
                     $res1 = $mng->executeQuery("sp.new_form", $query1);
                     if (!empty($res1)) {
                       foreach ($res1 as $bk) 
                       {
                      
                         $course = $bk->course;
                         $sem = $bk->sem;
                         $ay = $bk->ay;
                         $institute = $bk->institute;
                         $university = $bk->university;
                         $tf = $bk->tf;
                         $af = $bk->af;
                         $of = $bk->of;
                       }
                     }
        
    }
                    if(isset($_POST['approve'])){
                        
                        $fn = $_GET['first_name'];
                     $ln = $_GET['last_name'];
                     $mn = $_GET['mob_num'];
                     $un = $_GET['email'];
                         $st = $_POST['status'];
                        $rem = $_POST['remarks'];
                         $mgr = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                        
                        $bulk = new MongoDB\Driver\BulkWrite;
                        $bulk->update(
                            ['fname' => $fn,'lname' => $ln,'mob_num' => $mn,'email' => $un],
                            ['$set' => ['status'=>$st,'remarks'=>$rem]],
                            ['multi' => false, 'upsert' => false]
                        );

                        $result = $mgr->executeBulkWrite('sp.new_form', $bulk);
                            echo '<script>alert("Updated successfully");</script>';
                    }

     
            
        
    ?>

<!doctype html>
<html lang="en">
  <head>
    <title>Dashboard</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
<?php 
    session_start();




    $usr = $_SESSION['usr'];
    $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $query = new MongoDB\Driver\Query(['email' => $usr]);
    $res = $mng->executeQuery("sp.approver",$query);
    $stk = current($res->toArray());
  if(!empty($stk))
        {
         $fname=$stk->name;
         $email=$stk->email;
         
    }
     
    
                  
 ?>
 <script type="text/javascript">
  function loadnow() 
        {
        document.getElementById("title").style.display = "block";
        document.getElementById("dashboard").style.display = "block";
        document.getElementById("app_now").style.display = "none";
        document.getElementById("app_now1").style.display = "none";
        document.getElementById("total_reg").style.display = "none";
        document.getElementById("app_his").style.display = "none";
        document.getElementById("pen_his").style.display = "none";
        document.getElementById("obj_his").style.display = "none";
        }
  function app_now() 
       {
        document.getElementById("dashboard").style.display = "none";
        document.getElementById("app_now").style.display = "block";
        document.getElementById("app_now1").style.display = "block";
        document.getElementById("total_reg").style.display = "none";
        document.getElementById("app_his").style.display = "none";
        document.getElementById("pen_his").style.display = "none";
        document.getElementById("obj_his").style.display = "none";
        }
  
  function app_his()
        {
        document.getElementById("dashboard").style.display = "none";
        document.getElementById("app_now").style.display = "none";
        document.getElementById("app_now1").style.display = "none";
        document.getElementById("total_reg").style.display = "none";
        document.getElementById("app_his").style.display = "block";
        document.getElementById("pen_his").style.display = "none";
        document.getElementById("obj_his").style.display = "none";
        }
  function pen_his() 
       {
        document.getElementById("dashboard").style.display = "none";
        document.getElementById("app_now").style.display = "none";
        document.getElementById("app_now1").style.display = "none";
        document.getElementById("total_reg").style.display = "none";
        document.getElementById("app_his").style.display = "none";
        document.getElementById("pen_his").style.display = "block";
        document.getElementById("obj_his").style.display = "none";
        }
  function obj_his() 
       {
        document.getElementById("dashboard").style.display = "none";
        document.getElementById("app_now").style.display = "none";
        document.getElementById("app_now1").style.display = "none";
        document.getElementById("total_reg").style.display = "none";
        document.getElementById("app_his").style.display = "none";
        document.getElementById("pen_his").style.display = "none";
        document.getElementById("obj_his").style.display = "block";
        }
    function total_reg()
        {
        document.getElementById("dashboard").style.display = "none";
        document.getElementById("app_now").style.display = "none";
        document.getElementById("app_now1").style.display = "none";
        document.getElementById("total_reg").style.display = "block";
        document.getElementById("app_his").style.display = "none";
        document.getElementById("pen_his").style.display = "none";
        document.getElementById("obj_his").style.display = "none";
        }
    


 </script>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
   
    <link href="css/dashboard.css" rel="stylesheet">
  </head>
  <body onload="loadnow()" class="bg-light">

     <nav class="navbar navbar-dark sticky-top bg-light flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3 text-dark active" href="#" >MCA ScholarShip portal</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <img class="d-block mx-auto mb-2" src="img/icon.png" alt="" width="72" height="72">
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <span class="lead"><big>Hi,<?php echo $fname;  ?></big></span>
      <a class="nav-link text-dark" href="home.php">Sign out <span data-feather="log-in"></span></a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-5">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="#">
              <span data-feather="home"></span>
              <big>Dashboard </big><span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" onclick="app_now()" href="#">
              <span data-feather="award"></span>
              Change Status
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link t" onclick="app_his()" href="#">
              <span data-feather="user-check"></span>
              Approved Scholarship's
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link t" onclick="pen_his()" href="#">
              <span data-feather="clock"></span>
              Pending Scholarship's
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link t" onclick="obj_his()" href="#">
              <span data-feather="help-circle"></span>
              Objection Scholarship's
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link t" onclick="total_reg()" href="#">
              <span data-feather="list"></span>
              Total Registration's
            </a>
          </li>          
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4" id="title">
        <font size=20 class="text-light col-lg-10"><b>Dashboard</b></font>
    </main>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4" id="dashboard">
      <h3>Steps to Fill the Scholarship Form</h3>
      <font size=4 class="text-dark col-md-10">
        <ul type="circle">
          <li>Welcome to Admin Panel, Access the Menu of the left for different functionalities.</li>
        </ul>
      </font>
    </main>


    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4" id="app_now">
    <!-- <form class="needs-validation" action="" method="POST"> -->
    <h2>Change Status </h2><br><br>
    <center>
    <fieldset><legend class="col-md-4 rounded border border-dark text-center"><big>Change Status</big></legend>
    <div class="col-md-10 order-md-2 text-left">
      <form  method="GET" action="#" class="needs-validation">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">First Name</label>
            <input type="text" name="first_name" class="form-control" id="firstName" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Last name</label>
            <input type="text" name="last_name" class="form-control" id="lastName" required>
          </div>
        </div>
        <div class="mb-3 ">
          <label for="username">Mobile Number</label>
          <div class="input-group">
            <input type="mobile" name="mob_num" class="form-control" id="mobile" required>
          </div>
        </div>
        <div class="mb-3">
          <label for="email">Email</label>
          <input type="email" name="email" class="form-control" id="email" required>
        </div>
        </fieldset>
        
          <button type="submit" name="ftch" class="btn btn-primary btn-lg btn-block col-md-4" onclick="app_now1()">Submit</button><br><br>
      </form>
       </div>
        
      </div>
      </center>
     <!-- </form> -->
    </main>
    
    


    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4" id="app_now1">
      <form class="needs-validation" action="#" method="POST">
        <fieldset><legend class="col-md-4 rounded border border-dark text-center">Institute Information</legend>
        <div class="col-md-10 order-md-2 text-left">
          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="course">Course</label>
              <input type="text" name="course"  value="<?php echo $course;?>" class="custom-select d-block w-100" id="course" disabled>
              </div>
          
            <div class="col-md-4 mb-3">
              <label for="sem">Semester</label>
              <input type="text" name="sem" value="<?php echo $sem;?>" class="custom-select d-block w-100" id="Sem" disabled>
            </div>
            <div class="col-md-4 mb-3">
              <label for="ay">Academic Year</label>
              <input type="text" name="ay" value="<?php echo $ay;?>" class="custom-select d-block w-100" id="ay" disabled>
            </div>
            <div class="col-md-4 mb-3">
              <label for="institute">Institution</label>
              <input name="institute" value="<?php echo $institute;?>" class="custom-select d-block w-100" id="institute" disabled>
            </div>
            <div class="col-md-4 mb-3">
              <label for="university">University</label>
              <input name="university" value="<?php echo $university;?>" class="custom-select d-block w-100" id="university" disabled>
            </div>
          </div>
        </div>
        </fieldset>

        <hr class="mb-4">
        <fieldset><legend class="col-md-4 rounded border border-dark text-center">Fees Details</legend>
        <div class="col-md-10 order-md-2 text-left">
          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="tf">Tuition Fee</label>
              <input type="number" name="tf" value="<?php echo $tf;?>" class="form-control" id="tf" placeholder="₹" disabled>
            </div>
            <div class="col-md-4 mb-3">
              <label for="af">Admission Fees</label>
              <input type="number" name="af" value="<?php echo $af;?>" class="form-control" id="af" placeholder="₹" disabled>
            </div>
            <div class="col-md-4 mb-3">
              <label for="of">Other Fees</label>
              <input type="number" name="of" value="<?php echo $of;?>" class="form-control" id="of" placeholder="₹" disabled>
            </div>
          </div>
        
        <hr class="mb-4">
        <center>
        <fieldset>
        <div class="col-md-8 order-md-1 text-left">
          <form action="#" method="POST" class="needs-validation">
            <div class="row">
              <div class="col-md-10">
                <label for="status">Change Status</label>
                <select name="status" class="custom-select d-block w-100" id="status" required>
                    <option>Choose</option>
                    <option>Approved</option>
                    <option>Objection</option>
                    <option>Pending</option>
                    <option>Document Verification Due</option>
                  </select>
                <div class="invalid-feedback">
                  Select a Valid Option.
                </div>
              </div>
              <div class="col-md-10 mb-3">
                <label for="remarks">Remarks, If Any</label>
                <input type="text" name="remarks" class="form-control" id="remarks" placeholder="Anything Specific" value="" required>
              </div>        
            <div class=" col-md-10 mb-3 text-center">
              <button type="submit" class="btn btn-primary  btn-lg col-md-6 " value="submit" name="approve">Submit</button>
            </div>
            </form>
           </div>
          </div>
         </fieldset>
        </center>
         </form>


      </fieldset>
    </center>
     </form>
    </main>
<?php
      
     
      
?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4" id="app_his">
     <form class="needs-validation" action="" method="POST">
      <h2>Approved Scholarship's</h2>
      <center>
       <fieldset><legend class="col-md-4 rounded border border-dark text-center">Approved Scholarship's</legend>
        <div class="table-responsive">
        <table class="table table-striped table-lg">
              <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Mobile Number</th>
                <th>E-Mail</th>
                <th>Course</th>
                <th>Semester</th>
                <th>Academic Year</th>
                <th>Institute</th>
                <th>University</th>
                <th>Tution Fees</th>
                <th>Admission Fees</th>
                <th>Other Fees</th>
                <th>Status</th>
                <th>Remarks</th>
              </tr>
               <?php        
                    $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                    $filter = ['status'=>'Approved'];
                    $query = new MongoDB\Driver\Query($filter);      
                    $res = $mng->executeQuery("sp.new_form", $query);
                    if (!empty($res)) {
                      foreach ($res as $row) 
                      {
                 ?>
              <tr>
                <td><?php echo $row->fname;   ?></td>
                <td><?php echo $row->lname;   ?></td>
                <td><?php echo $row->mob_num;   ?></td>
                <td><?php echo $row->email;   ?></td>
                <td><?php echo $row->course;   ?></td>
                <td><?php echo $row->sem;   ?></td>
                <td><?php echo $row->ay;   ?></td>
                <td><?php echo $row->institute;   ?></td>
                <td><?php echo $row->university;   ?></td>
                <td><?php echo $row->tf;   ?></td>
                <td><?php echo $row->af;   ?></td>
                <td><?php echo $row->of;   ?></td>
                <td><?php echo $row->status;   ?></td>
                <td><?php echo $row->remarks;   ?></td>
              </tr>
              <?php } } else{echo "No Record Found";}  ?>
            </table>
          </div>
       </fieldset>
      </center>
     </form>
    </main>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4" id="pen_his">
     <form class="needs-validation" action="" method="POST">
      <h2>Pending Scholarship's</h2>
      <center>
        <fieldset><legend class="col-md-4 rounded border border-dark text-center">Pending Scholarship's</legend>
        <div class="table-responsive">
        <table class="table table-striped table-lg">
              <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Mobile Number</th>
                <th>E-Mail</th>
                <th>Course</th>
                <th>Semester</th>
                <th>Academic Year</th>
                <th>Institute</th>
                <th>University</th>
                <th>Tution Fees</th>
                <th>Admission Fees</th>
                <th>Other Fees</th>
                <th>Status</th>
                <th>Remarks</th>
              </tr>
               <?php        
                    $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                    $filter = ['status'=>'Pending'];
                    $query = new MongoDB\Driver\Query($filter);      
                    $res = $mng->executeQuery("sp.new_form", $query);
                    if (!empty($res)) {
                      foreach ($res as $row) 
                      {
                 ?>
              <tr>
                <td><?php echo $row->fname;   ?></td>
                <td><?php echo $row->lname;   ?></td>
                <td><?php echo $row->mob_num;   ?></td>
                <td><?php echo $row->email;   ?></td>
                <td><?php echo $row->course;   ?></td>
                <td><?php echo $row->sem;   ?></td>
                <td><?php echo $row->ay;   ?></td>
                <td><?php echo $row->institute;   ?></td>
                <td><?php echo $row->university;   ?></td>
                <td><?php echo $row->tf;   ?></td>
                <td><?php echo $row->af;   ?></td>
                <td><?php echo $row->of;   ?></td>
                <td><?php echo $row->status;   ?></td>
                <td><?php echo $row->remarks;   ?></td>
              </tr>
              <?php } }   ?>
            </table>
          </div>
        </fieldset>
      </center>
     </form>
    </main>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4" id="obj_his">
         <form class="needs-validation" action="" method="POST">
          <h2>Objection Scholarship's</h2>
          <center>
            <fieldset><legend class="col-md-4 rounded border border-dark text-center">Objection Scholarship's</legend>
            <div class="table-responsive">
            <table class="table table-striped table-lg">
                  <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Mobile Number</th>
                    <th>E-Mail</th>
                    <th>Course</th>
                    <th>Semester</th>
                    <th>Academic Year</th>
                    <th>Institute</th>
                    <th>University</th>
                    <th>Tution Fees</th>
                    <th>Admission Fees</th>
                    <th>Other Fees</th>
                    <th>Status</th>
                    <th>Remarks</th>
                  </tr>
                   <?php        
                        $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                        $filter = ['status'=>'Objection'];
                        $query = new MongoDB\Driver\Query($filter);      
                        $res = $mng->executeQuery("sp.new_form", $query);
                        if (!empty($res)) {
                          foreach ($res as $row) 
                          {
                     ?>
                  <tr>
                    <td><?php echo $row->fname;   ?></td>
                    <td><?php echo $row->lname;   ?></td>
                    <td><?php echo $row->mob_num;   ?></td>
                    <td><?php echo $row->email;   ?></td>
                    <td><?php echo $row->course;   ?></td>
                    <td><?php echo $row->sem;   ?></td>
                    <td><?php echo $row->ay;   ?></td>
                    <td><?php echo $row->institute;   ?></td>
                    <td><?php echo $row->university;   ?></td>
                    <td><?php echo $row->tf;   ?></td>
                    <td><?php echo $row->af;   ?></td>
                    <td><?php echo $row->of;   ?></td>
                    <td><?php echo $row->status;   ?></td>
                    <td><?php echo $row->remarks;   ?></td>
                  </tr>
                  <?php } }   ?>
                </table>
              </div>
            </fieldset>
          </center>
         </form>
        </main>


        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4" id="total_reg">
         <form class="needs-validation" action="" method="POST">
            <h2>Total Scholarship's Registrations</h2>
            <center>
            <fieldset><legend class="col-md-4 rounded border border-dark text-center">Total Registrations</legend>
              <div class="table-responsive">
            <table class="table table-striped table-lg">
                  <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Mobile Number</th>
                    <th>E-Mail</th>
                    <th>Course</th>
                    <th>Semester</th>
                    <th>Academic Year</th>
                    <th>Institute</th>
                    <th>University</th>
                    <th>Tution Fees</th>
                    <th>Admission Fees</th>
                    <th>Other Fees</th>
                    <th>Status</th>
                    <th>Remarks</th>
                  </tr>
                   <?php        
                        $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                        $filter = [];
                        $query = new MongoDB\Driver\Query($filter);      
                        $res = $mng->executeQuery("sp.new_form", $query);
                        if (!empty($res)) {
                          foreach ($res as $row) 
                          {
                     ?>
                  <tr>
                    <td><?php echo $row->fname;   ?></td>
                    <td><?php echo $row->lname;   ?></td>
                    <td><?php echo $row->mob_num;   ?></td>
                    <td><?php echo $row->email;   ?></td>
                    <td><?php echo $row->course;   ?></td>
                    <td><?php echo $row->sem;   ?></td>
                    <td><?php echo $row->ay;   ?></td>
                    <td><?php echo $row->institute;   ?></td>
                    <td><?php echo $row->university;   ?></td>
                    <td><?php echo $row->tf;   ?></td>
                    <td><?php echo $row->af;   ?></td>
                    <td><?php echo $row->of;   ?></td>
                    <td><?php echo $row->status;   ?></td>
                    <td><?php echo $row->remarks;   ?></td>
                  </tr>
                  <?php } } else{echo "No Record Found";}  ?>
                </table>
              </div>
            </fieldset>
          </center>
         </form>
        </main>

  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
      <script src="js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="js/dashboard.js"></script></body>
</html>
