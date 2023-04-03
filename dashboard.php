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
    $res = $mng->executeQuery("sp.signup",$query);
    $stk = current($res->toArray());
  if(!empty($stk))
        {
         $fname=$stk->fname;
         $lname=$stk->lname;
         $mob_num=$stk->mob_num;
         $email=$stk->email;
         $address=$stk->address;
         $state=$stk->state;
         $country=$stk->country;
         $zip=$stk->zip;
    }
    if(isset($_POST['a&s'])){
          $bulk = new MongoDB\Driver\BulkWrite;
          $sp=$_POST["sp"];
          $ssp=$_POST["ssp"];
          $gp=$_POST["gp"];
          $course=$_POST["course"];
          $sem=$_POST["sem"];
          $ay=$_POST["ay"];
          $institute=$_POST["institute"];
          $university=$_POST["university"];
          $tf=$_POST["tf"];
          $af=$_POST["af"];
          $of=$_POST["of"];
          $dos = date("Y");
          $doc1 = ['fname' => $fname, 'lname'=> $lname,'mob_num' => $mob_num,'email'=>$email,'address'=>$address,'state'=>$state,'country'=>$country,'zip'=>$zip,'sp'=>$sp,'ssp'=>$ssp,'gp'=>$gp,'course'=>$course,'sem'=>$sem,'ay'=>$ay,'institute'=>$institute,'university'=>$university,'tf'=>$tf,'af'=>$af,'of'=>$of,'status'=>'Pending','remarks'=>'-','dos'=>$dos];
          $bulk->insert($doc1);
          $mng->executeBulkWrite('sp.new_form', $bulk);
          echo "<script>alert('Now you can fill in the bank details for Payment Disbursement.');</script>";
//          header('location:dashboard.php');
          
        }
        if(isset($_POST['bank'])){
          $bulk = new MongoDB\Driver\BulkWrite;
          $bank_name=$_POST["bank_name"];
          $ac_no=$_POST["ac_no"];
          $ifsc=$_POST["ifsc"];
          $branch=$_POST["branch"];
          $doc1 = ['email'=>$email,'bank_name' => $bank_name, 'ac_no'=> $ac_no,'ifsc' => $ifsc,'branch'=>$branch];
          $bulk->insert($doc1);
          $mng->executeBulkWrite('sp.bank_details', $bulk);
          echo "<script>alert('Now wait for the Scholarship to get Approved from College.');</script>";
//          header('location:dashboard.php');
          
        }

    
 ?>
 <script type="text/javascript">
  function loadnow() 
        {
        document.getElementById("title").style.display = "block";
        document.getElementById("dashboard").style.display = "block";
        document.getElementById("new_form").style.display = "none";
        document.getElementById("bank_details").style.display = "none";
        document.getElementById("form_status").style.display = "none";
        }
  function new_form() 
       {
        document.getElementById("dashboard").style.display = "none";
        document.getElementById("new_form").style.display = "block";
        document.getElementById("bank_details").style.display = "none";
        document.getElementById("form_status").style.display = "none";
        }
  function bank_details()
        {
        document.getElementById("dashboard").style.display = "none";
        document.getElementById("new_form").style.display = "none";
        document.getElementById("bank_details").style.display = "block";
        document.getElementById("form_status").style.display = "none";
        }
  function form_status() 
       {
        document.getElementById("dashboard").style.display = "none";
        document.getElementById("new_form").style.display = "none";
        document.getElementById("bank_details").style.display = "none";
        document.getElementById("form_status").style.display = "block";
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
            <a class="nav-link" onclick="new_form()" href="#">
              <span data-feather="user-plus"></span>
              New Form
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link t" onclick="bank_details()" href="#">
              <span data-feather="dollar-sign"></span>
              Bank Details
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link t" onclick="form_status()" href="#">
              <span data-feather="user-check"></span>
              Form status
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
          <li>Step 1 : For New Form Application Click on "New Form" and fill in the Student Details.</li>
          <li>Step 2 : Fill in the Bank Details of the Student to get the Scholarship.</li>
          <li>Step 3 : Check on "Form Status" and Wait for the Form Status to change from "Pending" to "Approved" from the Authorities.</li>
          <li>Step 4 : After "Approved" it usually takes minimum 3-4 Working days for the Scholarship to be Credited to your Account.</li>
          <li>Step 5 : Scholarship Credited to your Account, Apply here again for your next Year.</li>
        </ul>
      </font>
    </main>


    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4" id="new_form">
    <form class="needs-validation" action="" method="POST">
    <h2>New Scholarship Form</h2><br><br>
    <center>
    <fieldset><legend class="col-md-4 rounded border border-dark text-center"><big>Personal Information</big></legend>
    <div class="col-md-10 order-md-2 text-left">
      <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">First name</label>
            <input type="text" name="first_name" value="<?php echo $fname;  ?>" class="form-control" id="firstName" disabled>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Last name</label>
            <input type="text" name="last_name" value="<?php echo $lname;  ?>" class="form-control" id="lastName" disabled>
          </div>
        </div>
        <div class="mb-3 ">
          <label for="username">Mobile Number</label>
          <div class="input-group">
            <input type="mobile" name="mob_num" value="<?php echo $mob_num;  ?>" class="form-control" id="mobile" disabled>
          </div>
        </div>
        <div class="mb-3">
          <label for="email">Email</label>
          <input type="email" name="email" value="<?php echo $email;  ?>" class="form-control" id="email" disabled>
        </div>
        <div class="mb-3">
          <label for="address">Address</label>
          <input type="text" name="address" value="<?php echo $address;  ?>" class="form-control" id="address" disabled>
        </div>
        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="state">State</label>
          <input type="text" name="State" value="<?php echo $state;  ?>" class="form-control" id="state" disabled>
          </div>
          <div class="col-md-4 mb-3">
            <label for="country">Country</label>
          <input type="text" name="country" value="<?php echo $country;  ?>" class="form-control" id="country" disabled>
          </div>
          <div class="col-md-3 mb-3">
            <label for="zip">Zip</label>
            <input type="text" name="zip" value="<?php echo $zip;  ?>" class="form-control" id="zip" disabled>
          </div>
        </div>
        </fieldset>
        <hr class="mb-4">
        <fieldset><legend class="col-md-4 rounded border border-dark text-center">Educational Information</legend>
        <div class="col-md-10 order-md-2 text-left">
          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="">Secondary Percentage</label>
              <input type="number" name="sp" class="form-control" id="sp" placeholder="10th Percentage" min="35" max="100">
            </div>
            <div class="col-md-4 mb-3">
              <label for="">Senior Secondary Percentage</label>
              <input type="number" name="ssp" class="form-control" id="ssp" placeholder="12th Percentage" min="35" max="100">
            </div>
            <div class="col-md-4 mb-3">
              <label for="">Graduation Percentage</label>
              <input type="number" name="gp" class="form-control" id="gp" placeholder="Graduation Percentage" min="35" max="100">
            </div>
          </div>
        </div>
        </fieldset>
        <hr class="mb-4">
        <fieldset><legend class="col-md-4 rounded border border-dark text-center">Institute Information</legend>
        <div class="col-md-10 order-md-2 text-left">
          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="course">Course</label>
              <select name="course" class="custom-select d-block w-100" id="course" required>
                <option value="">Choose</option>
                <option>Master of Computer Application</option>
              </select>
              <div class="invalid-feedback">
              Please select a valid Course.
            </div>
            </div>
            <div class="col-md-4 mb-3">
              <label for="sem">Semester</label>
              <select name="sem" class="custom-select d-block w-100" id="Sem" required>
                <option value="">Choose</option>
                <option>I st Semester</option>
                <option>II st Semester</option>
                <option>III st Semester</option>
                <option>IV st Semester</option>
                <option>V st Semester</option>
                <option>VI st Semester</option>
              </select>
              <div class="invalid-feedback">
              Please select a valid Semester.
            </div>
            </div>
            <div class="col-md-4 mb-3">
              <label for="ay">Academic Year</label>
              <select name="ay" class="custom-select d-block w-100" id="ay" required>
                <option value="">Choose</option>
                <option>2019-2020</option>
                <option>2020-2021</option>
                <option>2021-2022</option>
              </select>
              <div class="invalid-feedback">
              Please select a valid Year.
            </div>
            </div>
            <div class="col-md-4 mb-3">
              <label for="institute">Institution</label>
              <select name="institute" class="custom-select d-block w-100" id="institute" required>
                <option value="">Choose</option>
                <option>M. S. Ramaiah Institute of Technology, Banglore</option>
              </select>
              <div class="invalid-feedback">
              Please select a valid University.
            </div>
            </div>
            <div class="col-md-4 mb-3">
              <label for="university">University</label>
              <select name="university" class="custom-select d-block w-100" id="university" required>
                <option value="">Choose</option>
                <option>Vishveshwaraya Technical university</option>
              </select>
              <div class="invalid-feedback">
              Please select a valid University.
            </div>
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
              <input type="number" name="tf" class="form-control" id="tf" placeholder="₹" min="10000" max="200000">
            </div>
            <div class="invalid-feedback">
              Enter Tuition Fees.
            </div>
            <div class="col-md-4 mb-3">
              <label for="af">Admission Fees</label>
              <input type="number" name="af" class="form-control" id="af" placeholder="₹" min="200" max="20000">
            </div>
            <div class="invalid-feedback">
              Enter Academic Fees.
            </div>
            <div class="col-md-4 mb-3">
              <label for="of">Other Fees</label>
              <input type="number" name="of" class="form-control" id="of" placeholder="₹" min="100" max="1000">
            </div>
            <div class="invalid-feedback">
              Enter Other Fees.
            </div>
          </div>
        </div>
        </fieldset>
        <hr class="mb-4">
        
       
        <input type="checkbox" id="t&c" name="t&c" required>
        <label for="t&c"> I agree to all the *Terms & Conditions and assure that all the information above is correct to my knowledge.</label>
         <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block col-md-4" name="a&s">Agree & Submit</button>
        </form>
       </div>
      </div>
    </center>
     </form>
    </main>

    <main role="main" class="col-md-12 ml-sm-auto col-lg-15 px-md-4 " id="bank_details">
    <form class="needs-validation" action="" method="POST">
    <h2>Bank Details</h2>
    <center>
    <fieldset><legend class="col-md-4 rounded border border-dark text-center">Bank Details</legend>
    <div class="col-md-8 order-md-1 text-left">
      <form action="" method="POST" class="needs-validation" novalidate>
        <h2>Bank Account Details</h2>
        <div class="table-responsive">
        <table class="table table-striped table-lg">
              <tr>
                <th>Email</th>
                <th>Bank Name</th>
                <th>Account Number</th>
                <th>IFSC Code</th>
                <th>Branch</th>
              </tr>
               <?php        
                    $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                    $filter = ['email' => $usr];
                    $query = new MongoDB\Driver\Query($filter);      
                    $res = $mng->executeQuery("sp.bank_details", $query);
                    if (!empty($res)) {
                      foreach ($res as $bk) 
                      {
                 ?>
              <tr>
                <td><?php echo $bk->email;   ?></td>
                <td><?php echo $bk->bank_name;   ?></td>
                <td><?php echo $bk->ac_no;   ?></td>
                <td><?php echo $bk->ifsc;   ?></td>
                <td><?php echo $bk->branch;   ?></td>
              </tr>
              <?php } }  ?>
            </table>
            </div>
           
            <hr class="mb-4">
            <div class="row">
          <div class="col-md-10">
            <label for="bank_name">Bank</label>
            <select name="bank_name" class="custom-select d-block w-100" id="bank_name" required>
                <option>Choose</option>
                <option>ICICI Bank</option>
                <option>SBI Bank</option>
                <option>Vijaya Bank</option>
                <option>UCO Bank</option>
              </select>
            <div class="invalid-feedback">
              Select a Valid Bank.
            </div>
          </div>
          <div class="col-md-10 mb-3">
            <label for="ac_no">Account Number</label>
            <input type="number" name="ac_no" class="form-control" id="ac_no" placeholder="13 Digit Account Number" value="" required min="1000000000000" max="9999999999999">
            <div class="invalid-feedback">
              Enter Valid Account Number.
            </div>
          </div>
        
        <div class="col-md-10 mb-3">
          <label for="ifsc">IFSC Code</label>
          <div class="input-group">
            <input type="text" name="ifsc" class="form-control rounded" id="ifsc" placeholder="ABCD1234" pattern="[A-Z 0-9]{5,15}" required >
            <div class="invalid-feedback" style="width: 100%;">
              Enter valid IFSC Code.
            </div>
          </div>
        </div>

        <div class=" col-md-10 mb-3">
          <label for="branch">Branch</label>
          <select name="branch" class="custom-select d-block w-100" id="branch" required>
                <option>Choose</option>
                <option>MSR Nagar</option>
                <option>Electronic City</option>
                <option>Airport Road</option>
                <option>Jaya Nagar</option>
              </select>
          <div class="invalid-feedback">
            Select Valid Branch.
          </div>
        </div>
        <div class=" col-md-10 mb-3 text-center">
          <button class="btn btn-primary  btn-lg col-md-6 " name="bank">Submit</button>
        


        </div>
        </form>
       </div>
      </div>
     </fieldset>
    </center>
     </form>
    </main>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4" id="form_status">
     <form class="needs-validation" action="" method="POST">
        <h2>Form Status</h2>
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
                    $filter = ['email' => $usr];
                    $query = new MongoDB\Driver\Query($filter);      
                    $res = $mng->executeQuery("sp.new_form", $query);
                    if (!empty($res)) {
                      foreach ($res as $bk) 
                      {
                 ?>
              <tr>
                <td><?php echo $bk->fname;   ?></td>
                <td><?php echo $bk->lname;   ?></td>
                <td><?php echo $bk->mob_num;   ?></td>
                <td><?php echo $bk->email;   ?></td>
                <td><?php echo $bk->course;   ?></td>
                <td><?php echo $bk->sem;   ?></td>
                <td><?php echo $bk->ay;   ?></td>
                <td><?php echo $bk->institute;   ?></td>
                <td><?php echo $bk->university;   ?></td>
                <td><?php echo $bk->tf;   ?></td>
                <td><?php echo $bk->af;   ?></td>
                <td><?php echo $bk->of;   ?></td>
                <td><?php echo $bk->status;   ?></td>
                <td><?php echo $bk->remarks;   ?></td>
              </tr>
              <?php } }  ?>
            </table>
            </div>
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
