<?php

session_start();

require 'check.php';

$jName = $_SESSION['ACTIVE-USERNAME'];

$jID = $_SESSION['ACTIVE-ID'];

$loggedacctype = $_SESSION['ACTIVE-TYPE'];

require 'dbConnection.php';



$flag = "0";


if (isset($_GET['id'])) 
{
  $id = $_GET['id'];

  if (isset($_POST['submButton']))

    {
      $prov=$_POST['prov'];
      $beneficiary=$_POST['beneficiary'];
      $cyApproved=$_POST['cyApproved'];
      $mpex=$_POST['mpex'];
      $cpt=$_POST['cpt'];
      $gmpAssess=$_POST['gmpAssess'];
      $gmpSem=$_POST['gmpSem'];
      $pld=$_POST['pld'];
      $gmpMan=$_POST['gmpMan'];
      $ea=$_POST['ea'];
      $pcklbl=$_POST['pcklbl'];
      $campi=$_POST['campi'];

      $sql = "UPDATE `masterlist` SET `province`= '$prov' ,`beneficiary`= '$beneficiary',`cy_approvedsu`= '$cyApproved',`mpex`= '$mpex',`cpt`= '$cpt',`gmp_assessment`= '$gmpAssess',`gmp_seminar`= '$gmpSem',`plant_layout`= '$pld',`gmp_manual`= '$gmpMan',`ea`= '$ea',`packaging_labeling`= '$pcklbl',`campi`= '$campi' WHERE `id` = '$id';";    
      mysqli_query($mysqli, $sql)or die($mysqli->error);

      $flag = "success";
    }

  $q=mysqli_query($mysqli,"SELECT * FROM `masterlist` WHERE `id` = '$id'");
  $row = $q->fetch_assoc();

}
else
{
   echo '<script>location.replace("index.php")</script>';
}




if (isset($_POST['submUpload'])) {
  try 
  {

    $file_name = $_FILES['a-contentFile']['name'];
    $file_type = $_FILES['a-contentFile']['type'];
    $file_size = $_FILES['a-contentFile']['size'];
    $file_tmp_name= $_FILES['a-contentFile']['tmp_name'];
    $src = 'fileuploads/'.$file_name;

    $result = $mysqli->query("SELECT * FROM `upload_files` WHERE `file_name` = '$file_name';");
    
      if ( $result->num_rows == 0 )
      {
          $sql = "INSERT INTO `upload_files` (`id`, `ben_id`, `file_name`, `url`, `date_uploaded`) VALUES (NULL, '$id', '$file_name', '$src', CURRENT_TIMESTAMP);";
            
            mysqli_query($mysqli, $sql)or die($mysqli->error);

           
            // move_uploaded_file($file_tmp_name,"fileuploads/$file_name");

            if(move_uploaded_file($file_tmp_name,"fileuploads/$file_name")) 
            {
            chmod("fileuploads/$file_name", 0777);
            } 

          $flag = "upSuccess";
      }
      else 
      {
          $flag = "upError";
      }


    
  } catch (Exception $e) 
    {
  
    }

}


if (isset($_GET['rdid'])) 
{
  $rdid = $_GET['rdid'];
  $src = "fileuploads/".$rdid;

  $myFileLink = fopen($src, 'w') or die("can't open file");
  fclose($myFileLink);
  
  unlink($src) or die("Couldn't delete file");

  $sql = "DELETE FROM `upload_files` WHERE `file_name` = '$rdid';";    
  mysqli_query($mysqli, $sql)or die($mysqli->error);

  $flag = "delSuccess";
}





?>

<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">



  <title>DOST XI Consultancy Tracker System</title>

  <!-- Tell the browser to be responsive to screen width -->

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap 3.3.7 -->

  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->

  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->

  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">

  <!-- Theme style -->

  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins

       folder instead of downloading all of them to reduce the load. -->

  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- Morris chart -->

  <link rel="stylesheet" href="bower_components/morris.js/morris.css">

  <!-- jvectormap -->

  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">

  <!-- Date Picker -->

  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

  <!-- Daterange picker -->

  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">

  <!-- bootstrap wysihtml5 - text editor -->

  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">



  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

  <!--[if lt IE 9]>

  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

  <![endif]-->



  <!-- Google Font -->

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">





   <!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"

   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="

   crossorigin=""/>



   <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"

   integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="

   crossorigin=""></script>

 -->



 	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	

	<link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico">



    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="">

    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>





   <script src="https://d3js.org/d3.v3.min.js"></script>

   <script src="https://d3js.org/topojson.v0.min.js"></script>



</head>

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">



  <header class="main-header">

    <!-- Logo -->

    <a href="index.php" class="logo">

      <!-- mini logo for sidebar mini 50x50 pixels -->

      <span class="logo-mini"></span>

      <!-- logo for regular state and mobile devices -->

      <span class="logo-lg">DOST XI</span>

    </a>

    <!-- Header Navbar: style can be found in header.less -->

    <nav class="navbar navbar-static-top">

      <!-- Sidebar toggle button-->

<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">

        <span class="sr-only">Toggle navigation</span>

      </a>

      <div class="navbar-custom-menu">

            <a href="logout.php" style="color: white;">

              <button style="background: black; border: none; padding-left: 8px;padding-right: 8px;">LOGOUT</button> 

            </a>

      </div>

    </nav>

  </header>

  <!-- Left side column. contains the logo and sidebar -->

  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->

    <section class="sidebar">

      <!-- Sidebar user panel -->

      <div class="user-panel">

        <div class="pull-left image">

          <img src="logo/dosticon.png" class="img-circle" alt="User Image">

        </div>

        <div class="pull-left info">

          <p><?php echo $jName; ?></p>

          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>

        </div>

      </div>

      <!-- search form -->

     

      <!-- /.search form -->

      <!-- sidebar menu: : style can be found in sidebar.less -->

      <ul class="sidebar-menu" data-widget="tree">

        <li class="header">MAIN NAVIGATION</li>

        

        <li class="treeview">

          <a href="#">

            <i class="fa fa-users"></i>

            <span>Consultancy</span>

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu">

            <li ><a href="index.php"><i class="fa fa-circle-o"></i> New Firm</a></li>
            <li ><a href="masterlist.php"><i class="fa fa-circle-o"></i> Masterlist</a></li>
            <li ><a href="reports.php"><i class="fa fa-circle-o"></i> Reports</a></li>
            <!-- <li><a href="result.php"><i class="fa fa-circle-o"></i> Results</a></li>

 -->          </ul>

        </li>


<?php 
if ($loggedacctype == "Administrator") {
  echo '<li class="treeview">

          <a href="#">

            <i class="fa fa-users"></i>

            <span>Account Settings</span>

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu">

            <li class=""><a href="admin.php"><i class="fa fa-circle-o"></i> User Accounts</a></li>

          </ul>

        </li>';
}

?>



       

       

        

      </ul>

    </section>

    <!-- /.sidebar -->

  </aside>


<form id="upd" action="update.php?id=<?php echo $id; ?>" method="POST">
  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

  <a href="masterlist.php"> <button form="j"  style="margin-bottom: 15px;" class="btn btn-primary btn-xs" style="color: white;">Go Back</button>
</a>
      <h1>

        Update / Attach File Module

        <!-- <small>Consultancy Services Provided by DOST XI to SETUP Cooperators</small> -->

      </h1>

      

    </section>





<section class="content" >

<form name="newfirm" method="POST" action="index.php">



<div class="alert alert-success alert-dismissible" id="success" style="display: none;">
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check" style=" padding: 0px;"></i> Success!</h4>Information successfully updated!

</div>









<div class="box box-info">

            <div class="box-header with-border">

              <h3 class="box-title">Firm's Profile</h3>

            </div>

    <div class="row" style="margin-bottom: 15px;">

      

    </div>







  <div class="row" style="margin-bottom: 15px;">



    <div class="col-md-6">

              <div class="box-body">

                <div class="form-group">

                  <label for="id">ID No.</label>
                  <input readonly="" type="text" name="id" class="form-control" value="<?php echo($id); ?>">

                </div>

              </div>

    </div>

    <div class="col-md-6" >

              <div class="box-body">

                <div class="form-group">

                  <label for="prov">Province</label>

                  <select name="prov" id="prov" class="form-control" >
                    <option value="Compostela Valley" <?php if ($row['province']=="Compostela Valley") {echo "selected";}  ?>>Compostela Valley</option>
                    <option value="Davao City" <?php if ($row['province']=="Davao City") {echo "selected";}  ?>>Davao City</option>
                    <option value="Davao Del Norte" <?php if ($row['province']=="Davao Del Norte") {echo "selected";}  ?>>Davao Del Norte</option>
                    <option value="Davao Del Sur" <?php if ($row['province']=="Davao Del Sur") {echo "selected";}  ?>>Davao Del Sur</option>
                    <option value="Davao Oriental" <?php if ($row['province']=="Davao Oriental") {echo "selected";}  ?>>Davao Oriental</option>
                  </select>

                </div>

              </div>

    </div>

    

    </div>





  <div class="row" style="margin-bottom: 15px;">

    



    <div class="col-md-6">

      <div class="box-body">

                <div class="form-group">

                  <label for="beneficiary">Beneficiary</label>

                  <input autocomplete="off" value="<?php echo $row['beneficiary']; ?>" type="text" name="beneficiary" class="form-control" id="beneficiary" placeholder="Ex. Juan Dela Cruz Inc." required>
                </div>
              </div>

    </div>


    <div class="col-md-6" >

              <div class="box-body">

                <div class="form-group">

                  <label for="cyApproved">CY (approved SETUP)</label>

                  <input autocomplete="off" value="<?php echo $row['cy_approvedsu']; ?>" type="number" name="cyApproved" class="form-control" id="cyApproved" placeholder="Ex. 2019">

                </div>

              </div>
    </div>


  </div>


<div class="box-footer"></div>

</div>









<div class="box box-warning">

            <div class="box-header with-border">

              <h3 class="box-title">Provided Services</h3>

            </div>

    <div class="row" style="margin-bottom: 15px;">
    </div>

 
  <div class="row" style="margin-bottom: 15px;">

    <div class="col-md-6">

      <div class="box-body">

                <div class="form-group">

                  <label for="mpex">Manufacturing Productivity Extension (<b>MPEX</b>) Program</label>

                  <select name="mpex" id="mpex" class="form-control" >
                    <option value="---" <?php if ($row['mpex']=="---") {echo "selected";}  ?>>---</option>
                    <option value="N/A" <?php if ($row['mpex']=="N/A") {echo "selected";}  ?>>N/A</option>
                    <option value="Accomplished" <?php if ($row['mpex']=="Accomplished") {echo "selected";}  ?>>Accomplished</option>
                    <option value="2040" <?php if ($row['mpex']=="2040") {echo "selected";}  ?>>2040</option>
                    <option value="2039" <?php if ($row['mpex']=="2039") {echo "selected";}  ?>>2039</option>
                    <option value="2038" <?php if ($row['mpex']=="2038") {echo "selected";}  ?>>2038</option>
                    <option value="2037" <?php if ($row['mpex']=="2037") {echo "selected";}  ?>>2037</option>
                    <option value="2036" <?php if ($row['mpex']=="2036") {echo "selected";}  ?>>2036</option>
                    <option value="2035" <?php if ($row['mpex']=="2035") {echo "selected";}  ?>>2035</option>
                    <option value="2034" <?php if ($row['mpex']=="2034") {echo "selected";}  ?>>2034</option>
                    <option value="2033" <?php if ($row['mpex']=="2033") {echo "selected";}  ?>>2033</option>
                    <option value="2032" <?php if ($row['mpex']=="2032") {echo "selected";}  ?>>2032</option>
                    <option value="2031" <?php if ($row['mpex']=="2031") {echo "selected";}  ?>>2031</option>
                    <option value="2030" <?php if ($row['mpex']=="2030") {echo "selected";}  ?>>2030</option>
                    <option value="2029" <?php if ($row['mpex']=="2029") {echo "selected";}  ?>>2029</option>
                    <option value="2028" <?php if ($row['mpex']=="2028") {echo "selected";}  ?>>2028</option>
                    <option value="2027" <?php if ($row['mpex']=="2027") {echo "selected";}  ?>>2027</option>
                    <option value="2026" <?php if ($row['mpex']=="2026") {echo "selected";}  ?>>2026</option>
                    <option value="2025" <?php if ($row['mpex']=="2025") {echo "selected";}  ?>>2025</option>
                    <option value="2024" <?php if ($row['mpex']=="2024") {echo "selected";}  ?>>2024</option>
                    <option value="2023" <?php if ($row['mpex']=="2023") {echo "selected";}  ?>>2023</option>
                    <option value="2022" <?php if ($row['mpex']=="2022") {echo "selected";}  ?>>2022</option>
                    <option value="2021" <?php if ($row['mpex']=="2021") {echo "selected";}  ?>>2021</option>
                    <option value="2020" <?php if ($row['mpex']=="2020") {echo "selected";}  ?>>2020</option>
                    <option value="2019" <?php if ($row['mpex']=="2019") {echo "selected";}  ?>>2019</option>
                    <option value="2018" <?php if ($row['mpex']=="2018") {echo "selected";}  ?>>2018</option>
                    <option value="2017" <?php if ($row['mpex']=="2017") {echo "selected";}  ?>>2017</option>
                    <option value="2016" <?php if ($row['mpex']=="2016") {echo "selected";}  ?>>2016</option>
                    <option value="2015" <?php if ($row['mpex']=="2015") {echo "selected";}  ?>>2015</option>
                    <option value="2014" <?php if ($row['mpex']=="2014") {echo "selected";}  ?>>2014</option>
                    <option value="2013" <?php if ($row['mpex']=="2013") {echo "selected";}  ?>>2013</option>
                    <option value="2012" <?php if ($row['mpex']=="2012") {echo "selected";}  ?>>2012</option>
                    <option value="2011" <?php if ($row['mpex']=="2011") {echo "selected";}  ?>>2011</option>
                    <option value="2010" <?php if ($row['mpex']=="2010") {echo "selected";}  ?>>2010</option>
                    <option value="2009" <?php if ($row['mpex']=="2009") {echo "selected";}  ?>>2009</option>
                    <option value="2008" <?php if ($row['mpex']=="2008") {echo "selected";}  ?>>2008</option>
                    <option value="2007" <?php if ($row['mpex']=="2007") {echo "selected";}  ?>>2007</option>
                    <option value="2006" <?php if ($row['mpex']=="2006") {echo "selected";}  ?>>2006</option>
                    <option value="2005" <?php if ($row['mpex']=="2005") {echo "selected";}  ?>>2005</option>
                    <option value="2004" <?php if ($row['mpex']=="2004") {echo "selected";}  ?>>2004</option>
                    <option value="2003" <?php if ($row['mpex']=="2003") {echo "selected";}  ?>>2003</option>
                    <option value="2002" <?php if ($row['mpex']=="2002") {echo "selected";}  ?>>2002</option>
                    <option value="2001" <?php if ($row['mpex']=="2001") {echo "selected";}  ?>>2001</option>
                    <option value="2000" <?php if ($row['mpex']=="2000") {echo "selected";}  ?>>2000</option>
                    <option value="1999" <?php if ($row['mpex']=="1999") {echo "selected";}  ?>>1999</option>
                    <option value="1998" <?php if ($row['mpex']=="1998") {echo "selected";}  ?>>1998</option>
                    <option value="1997" <?php if ($row['mpex']=="1997") {echo "selected";}  ?>>1997</option>
                    <option value="1996" <?php if ($row['mpex']=="1996") {echo "selected";}  ?>>1996</option>
                    <option value="1995" <?php if ($row['mpex']=="1995") {echo "selected";}  ?>>1995</option>
                    <option value="1994" <?php if ($row['mpex']=="1994") {echo "selected";}  ?>>1994</option>
                    <option value="1993" <?php if ($row['mpex']=="1993") {echo "selected";}  ?>>1993</option>
                    <option value="1992" <?php if ($row['mpex']=="1992") {echo "selected";}  ?>>1992</option>
                    <option value="1991" <?php if ($row['mpex']=="1991") {echo "selected";}  ?>>1991</option>
                    <option value="1990" <?php if ($row['mpex']=="1990") {echo "selected";}  ?>>1990</option>
                  </select>

                </div>

               

              </div>

    </div>




    <div class="col-md-6">

      <div class="box-body">

                <div class="form-group">

                  <label for="cpt">Cleaner Production Technology (<b>CPT</b>) Assessment</label>

                  <select name="cpt" id="cpt" class="form-control" >
                    <option value="---" <?php if ($row['cpt']=="---") {echo "selected";}  ?>>---</option>
                    <option value="N/A" <?php if ($row['cpt']=="N/A") {echo "selected";}  ?>>N/A</option>
                    <option value="Accomplished" <?php if ($row['cpt']=="Accomplished") {echo "selected";}  ?>>Accomplished</option>
                    <option value="2040" <?php if ($row['cpt']=="2040") {echo "selected";}  ?>>2040</option>
                    <option value="2039" <?php if ($row['cpt']=="2039") {echo "selected";}  ?>>2039</option>
                    <option value="2038" <?php if ($row['cpt']=="2038") {echo "selected";}  ?>>2038</option>
                    <option value="2037" <?php if ($row['cpt']=="2037") {echo "selected";}  ?>>2037</option>
                    <option value="2036" <?php if ($row['cpt']=="2036") {echo "selected";}  ?>>2036</option>
                    <option value="2035" <?php if ($row['cpt']=="2035") {echo "selected";}  ?>>2035</option>
                    <option value="2034" <?php if ($row['cpt']=="2034") {echo "selected";}  ?>>2034</option>
                    <option value="2033" <?php if ($row['cpt']=="2033") {echo "selected";}  ?>>2033</option>
                    <option value="2032" <?php if ($row['cpt']=="2032") {echo "selected";}  ?>>2032</option>
                    <option value="2031" <?php if ($row['cpt']=="2031") {echo "selected";}  ?>>2031</option>
                    <option value="2030" <?php if ($row['cpt']=="2030") {echo "selected";}  ?>>2030</option>
                    <option value="2029" <?php if ($row['cpt']=="2029") {echo "selected";}  ?>>2029</option>
                    <option value="2028" <?php if ($row['cpt']=="2028") {echo "selected";}  ?>>2028</option>
                    <option value="2027" <?php if ($row['cpt']=="2027") {echo "selected";}  ?>>2027</option>
                    <option value="2026" <?php if ($row['cpt']=="2026") {echo "selected";}  ?>>2026</option>
                    <option value="2025" <?php if ($row['cpt']=="2025") {echo "selected";}  ?>>2025</option>
                    <option value="2024" <?php if ($row['cpt']=="2024") {echo "selected";}  ?>>2024</option>
                    <option value="2023" <?php if ($row['cpt']=="2023") {echo "selected";}  ?>>2023</option>
                    <option value="2022" <?php if ($row['cpt']=="2022") {echo "selected";}  ?>>2022</option>
                    <option value="2021" <?php if ($row['cpt']=="2021") {echo "selected";}  ?>>2021</option>
                    <option value="2020" <?php if ($row['cpt']=="2020") {echo "selected";}  ?>>2020</option>
                    <option value="2019" <?php if ($row['cpt']=="2019") {echo "selected";}  ?>>2019</option>
                    <option value="2018" <?php if ($row['cpt']=="2018") {echo "selected";}  ?>>2018</option>
                    <option value="2017" <?php if ($row['cpt']=="2017") {echo "selected";}  ?>>2017</option>
                    <option value="2016" <?php if ($row['cpt']=="2016") {echo "selected";}  ?>>2016</option>
                    <option value="2015" <?php if ($row['cpt']=="2015") {echo "selected";}  ?>>2015</option>
                    <option value="2014" <?php if ($row['cpt']=="2014") {echo "selected";}  ?>>2014</option>
                    <option value="2013" <?php if ($row['cpt']=="2013") {echo "selected";}  ?>>2013</option>
                    <option value="2012" <?php if ($row['cpt']=="2012") {echo "selected";}  ?>>2012</option>
                    <option value="2011" <?php if ($row['cpt']=="2011") {echo "selected";}  ?>>2011</option>
                    <option value="2010" <?php if ($row['cpt']=="2010") {echo "selected";}  ?>>2010</option>
                    <option value="2009" <?php if ($row['cpt']=="2009") {echo "selected";}  ?>>2009</option>
                    <option value="2008" <?php if ($row['cpt']=="2008") {echo "selected";}  ?>>2008</option>
                    <option value="2007" <?php if ($row['cpt']=="2007") {echo "selected";}  ?>>2007</option>
                    <option value="2006" <?php if ($row['cpt']=="2006") {echo "selected";}  ?>>2006</option>
                    <option value="2005" <?php if ($row['cpt']=="2005") {echo "selected";}  ?>>2005</option>
                    <option value="2004" <?php if ($row['cpt']=="2004") {echo "selected";}  ?>>2004</option>
                    <option value="2003" <?php if ($row['cpt']=="2003") {echo "selected";}  ?>>2003</option>
                    <option value="2002" <?php if ($row['cpt']=="2002") {echo "selected";}  ?>>2002</option>
                    <option value="2001" <?php if ($row['cpt']=="2001") {echo "selected";}  ?>>2001</option>
                    <option value="2000" <?php if ($row['cpt']=="2000") {echo "selected";}  ?>>2000</option>
                    <option value="1999" <?php if ($row['cpt']=="1999") {echo "selected";}  ?>>1999</option>
                    <option value="1998" <?php if ($row['cpt']=="1998") {echo "selected";}  ?>>1998</option>
                    <option value="1997" <?php if ($row['cpt']=="1997") {echo "selected";}  ?>>1997</option>
                    <option value="1996" <?php if ($row['cpt']=="1996") {echo "selected";}  ?>>1996</option>
                    <option value="1995" <?php if ($row['cpt']=="1995") {echo "selected";}  ?>>1995</option>
                    <option value="1994" <?php if ($row['cpt']=="1994") {echo "selected";}  ?>>1994</option>
                    <option value="1993" <?php if ($row['cpt']=="1993") {echo "selected";}  ?>>1993</option>
                    <option value="1992" <?php if ($row['cpt']=="1992") {echo "selected";}  ?>>1992</option>
                    <option value="1991" <?php if ($row['cpt']=="1991") {echo "selected";}  ?>>1991</option>
                    <option value="1990" <?php if ($row['cpt']=="1990") {echo "selected";}  ?>>1990</option>
                  </select>

                </div>

               

              </div>

    </div>

  </div>




   <div class="row" style="margin-bottom: 15px;">

    <div class="col-md-6">

      <div class="box-body">

                <div class="form-group">

                  <label for="gmpAssess">Good Manufacturing Practices (<b>GMP</b>) Assessment</label>

                  <select name="gmpAssess" id="gmpAssess" class="form-control" >
                    <option value="---" <?php if ($row['gmp_assessment']=="---") {echo "selected";}  ?>>---</option>
                    <option value="N/A" <?php if ($row['gmp_assessment']=="N/A") {echo "selected";}  ?>>N/A</option>
                    <option value="Accomplished" <?php if ($row['gmp_assessment']=="Accomplished") {echo "selected";}  ?>>Accomplished</option>
                    <option value="2040" <?php if ($row['gmp_assessment']=="2040") {echo "selected";}  ?>>2040</option>
                    <option value="2039" <?php if ($row['gmp_assessment']=="2039") {echo "selected";}  ?>>2039</option>
                    <option value="2038" <?php if ($row['gmp_assessment']=="2038") {echo "selected";}  ?>>2038</option>
                    <option value="2037" <?php if ($row['gmp_assessment']=="2037") {echo "selected";}  ?>>2037</option>
                    <option value="2036" <?php if ($row['gmp_assessment']=="2036") {echo "selected";}  ?>>2036</option>
                    <option value="2035" <?php if ($row['gmp_assessment']=="2035") {echo "selected";}  ?>>2035</option>
                    <option value="2034" <?php if ($row['gmp_assessment']=="2034") {echo "selected";}  ?>>2034</option>
                    <option value="2033" <?php if ($row['gmp_assessment']=="2033") {echo "selected";}  ?>>2033</option>
                    <option value="2032" <?php if ($row['gmp_assessment']=="2032") {echo "selected";}  ?>>2032</option>
                    <option value="2031" <?php if ($row['gmp_assessment']=="2031") {echo "selected";}  ?>>2031</option>
                    <option value="2030" <?php if ($row['gmp_assessment']=="2030") {echo "selected";}  ?>>2030</option>
                    <option value="2029" <?php if ($row['gmp_assessment']=="2029") {echo "selected";}  ?>>2029</option>
                    <option value="2028" <?php if ($row['gmp_assessment']=="2028") {echo "selected";}  ?>>2028</option>
                    <option value="2027" <?php if ($row['gmp_assessment']=="2027") {echo "selected";}  ?>>2027</option>
                    <option value="2026" <?php if ($row['gmp_assessment']=="2026") {echo "selected";}  ?>>2026</option>
                    <option value="2025" <?php if ($row['gmp_assessment']=="2025") {echo "selected";}  ?>>2025</option>
                    <option value="2024" <?php if ($row['gmp_assessment']=="2024") {echo "selected";}  ?>>2024</option>
                    <option value="2023" <?php if ($row['gmp_assessment']=="2023") {echo "selected";}  ?>>2023</option>
                    <option value="2022" <?php if ($row['gmp_assessment']=="2022") {echo "selected";}  ?>>2022</option>
                    <option value="2021" <?php if ($row['gmp_assessment']=="2021") {echo "selected";}  ?>>2021</option>
                    <option value="2020" <?php if ($row['gmp_assessment']=="2020") {echo "selected";}  ?>>2020</option>
                    <option value="2019" <?php if ($row['gmp_assessment']=="2019") {echo "selected";}  ?>>2019</option>
                    <option value="2018" <?php if ($row['gmp_assessment']=="2018") {echo "selected";}  ?>>2018</option>
                    <option value="2017" <?php if ($row['gmp_assessment']=="2017") {echo "selected";}  ?>>2017</option>
                    <option value="2016" <?php if ($row['gmp_assessment']=="2016") {echo "selected";}  ?>>2016</option>
                    <option value="2015" <?php if ($row['gmp_assessment']=="2015") {echo "selected";}  ?>>2015</option>
                    <option value="2014" <?php if ($row['gmp_assessment']=="2014") {echo "selected";}  ?>>2014</option>
                    <option value="2013" <?php if ($row['gmp_assessment']=="2013") {echo "selected";}  ?>>2013</option>
                    <option value="2012" <?php if ($row['gmp_assessment']=="2012") {echo "selected";}  ?>>2012</option>
                    <option value="2011" <?php if ($row['gmp_assessment']=="2011") {echo "selected";}  ?>>2011</option>
                    <option value="2010" <?php if ($row['gmp_assessment']=="2010") {echo "selected";}  ?>>2010</option>
                    <option value="2009" <?php if ($row['gmp_assessment']=="2009") {echo "selected";}  ?>>2009</option>
                    <option value="2008" <?php if ($row['gmp_assessment']=="2008") {echo "selected";}  ?>>2008</option>
                    <option value="2007" <?php if ($row['gmp_assessment']=="2007") {echo "selected";}  ?>>2007</option>
                    <option value="2006" <?php if ($row['gmp_assessment']=="2006") {echo "selected";}  ?>>2006</option>
                    <option value="2005" <?php if ($row['gmp_assessment']=="2005") {echo "selected";}  ?>>2005</option>
                    <option value="2004" <?php if ($row['gmp_assessment']=="2004") {echo "selected";}  ?>>2004</option>
                    <option value="2003" <?php if ($row['gmp_assessment']=="2003") {echo "selected";}  ?>>2003</option>
                    <option value="2002" <?php if ($row['gmp_assessment']=="2002") {echo "selected";}  ?>>2002</option>
                    <option value="2001" <?php if ($row['gmp_assessment']=="2001") {echo "selected";}  ?>>2001</option>
                    <option value="2000" <?php if ($row['gmp_assessment']=="2000") {echo "selected";}  ?>>2000</option>
                    <option value="1999" <?php if ($row['gmp_assessment']=="1999") {echo "selected";}  ?>>1999</option>
                    <option value="1998" <?php if ($row['gmp_assessment']=="1998") {echo "selected";}  ?>>1998</option>
                    <option value="1997" <?php if ($row['gmp_assessment']=="1997") {echo "selected";}  ?>>1997</option>
                    <option value="1996" <?php if ($row['gmp_assessment']=="1996") {echo "selected";}  ?>>1996</option>
                    <option value="1995" <?php if ($row['gmp_assessment']=="1995") {echo "selected";}  ?>>1995</option>
                    <option value="1994" <?php if ($row['gmp_assessment']=="1994") {echo "selected";}  ?>>1994</option>
                    <option value="1993" <?php if ($row['gmp_assessment']=="1993") {echo "selected";}  ?>>1993</option>
                    <option value="1992" <?php if ($row['gmp_assessment']=="1992") {echo "selected";}  ?>>1992</option>
                    <option value="1991" <?php if ($row['gmp_assessment']=="1991") {echo "selected";}  ?>>1991</option>
                    <option value="1990" <?php if ($row['gmp_assessment']=="1990") {echo "selected";}  ?>>1990</option>
                  </select>

                </div>

               

              </div>

    </div>




    <div class="col-md-6">

      <div class="box-body">

                <div class="form-group">

                  <label for="gmpSem">Good Manufacturing Practices (<b>GMP</b>) Seminar</label>

                  <select name="gmpSem" id="gmpSem" class="form-control" >
                    <option value="---" <?php if ($row['gmp_seminar']=="---") {echo "selected";}  ?>>---</option>
                    <option value="N/A" <?php if ($row['gmp_seminar']=="N/A") {echo "selected";}  ?>>N/A</option>
                    <option value="Accomplished" <?php if ($row['gmp_seminar']=="Accomplished") {echo "selected";}  ?>>Accomplished</option>
                    <option value="2040" <?php if ($row['gmp_seminar']=="2040") {echo "selected";}  ?>>2040</option>
                    <option value="2039" <?php if ($row['gmp_seminar']=="2039") {echo "selected";}  ?>>2039</option>
                    <option value="2038" <?php if ($row['gmp_seminar']=="2038") {echo "selected";}  ?>>2038</option>
                    <option value="2037" <?php if ($row['gmp_seminar']=="2037") {echo "selected";}  ?>>2037</option>
                    <option value="2036" <?php if ($row['gmp_seminar']=="2036") {echo "selected";}  ?>>2036</option>
                    <option value="2035" <?php if ($row['gmp_seminar']=="2035") {echo "selected";}  ?>>2035</option>
                    <option value="2034" <?php if ($row['gmp_seminar']=="2034") {echo "selected";}  ?>>2034</option>
                    <option value="2033" <?php if ($row['gmp_seminar']=="2033") {echo "selected";}  ?>>2033</option>
                    <option value="2032" <?php if ($row['gmp_seminar']=="2032") {echo "selected";}  ?>>2032</option>
                    <option value="2031" <?php if ($row['gmp_seminar']=="2031") {echo "selected";}  ?>>2031</option>
                    <option value="2030" <?php if ($row['gmp_seminar']=="2030") {echo "selected";}  ?>>2030</option>
                    <option value="2029" <?php if ($row['gmp_seminar']=="2029") {echo "selected";}  ?>>2029</option>
                    <option value="2028" <?php if ($row['gmp_seminar']=="2028") {echo "selected";}  ?>>2028</option>
                    <option value="2027" <?php if ($row['gmp_seminar']=="2027") {echo "selected";}  ?>>2027</option>
                    <option value="2026" <?php if ($row['gmp_seminar']=="2026") {echo "selected";}  ?>>2026</option>
                    <option value="2025" <?php if ($row['gmp_seminar']=="2025") {echo "selected";}  ?>>2025</option>
                    <option value="2024" <?php if ($row['gmp_seminar']=="2024") {echo "selected";}  ?>>2024</option>
                    <option value="2023" <?php if ($row['gmp_seminar']=="2023") {echo "selected";}  ?>>2023</option>
                    <option value="2022" <?php if ($row['gmp_seminar']=="2022") {echo "selected";}  ?>>2022</option>
                    <option value="2021" <?php if ($row['gmp_seminar']=="2021") {echo "selected";}  ?>>2021</option>
                    <option value="2020" <?php if ($row['gmp_seminar']=="2020") {echo "selected";}  ?>>2020</option>
                    <option value="2019" <?php if ($row['gmp_seminar']=="2019") {echo "selected";}  ?>>2019</option>
                    <option value="2018" <?php if ($row['gmp_seminar']=="2018") {echo "selected";}  ?>>2018</option>
                    <option value="2017" <?php if ($row['gmp_seminar']=="2017") {echo "selected";}  ?>>2017</option>
                    <option value="2016" <?php if ($row['gmp_seminar']=="2016") {echo "selected";}  ?>>2016</option>
                    <option value="2015" <?php if ($row['gmp_seminar']=="2015") {echo "selected";}  ?>>2015</option>
                    <option value="2014" <?php if ($row['gmp_seminar']=="2014") {echo "selected";}  ?>>2014</option>
                    <option value="2013" <?php if ($row['gmp_seminar']=="2013") {echo "selected";}  ?>>2013</option>
                    <option value="2012" <?php if ($row['gmp_seminar']=="2012") {echo "selected";}  ?>>2012</option>
                    <option value="2011" <?php if ($row['gmp_seminar']=="2011") {echo "selected";}  ?>>2011</option>
                    <option value="2010" <?php if ($row['gmp_seminar']=="2010") {echo "selected";}  ?>>2010</option>
                    <option value="2009" <?php if ($row['gmp_seminar']=="2009") {echo "selected";}  ?>>2009</option>
                    <option value="2008" <?php if ($row['gmp_seminar']=="2008") {echo "selected";}  ?>>2008</option>
                    <option value="2007" <?php if ($row['gmp_seminar']=="2007") {echo "selected";}  ?>>2007</option>
                    <option value="2006" <?php if ($row['gmp_seminar']=="2006") {echo "selected";}  ?>>2006</option>
                    <option value="2005" <?php if ($row['gmp_seminar']=="2005") {echo "selected";}  ?>>2005</option>
                    <option value="2004" <?php if ($row['gmp_seminar']=="2004") {echo "selected";}  ?>>2004</option>
                    <option value="2003" <?php if ($row['gmp_seminar']=="2003") {echo "selected";}  ?>>2003</option>
                    <option value="2002" <?php if ($row['gmp_seminar']=="2002") {echo "selected";}  ?>>2002</option>
                    <option value="2001" <?php if ($row['gmp_seminar']=="2001") {echo "selected";}  ?>>2001</option>
                    <option value="2000" <?php if ($row['gmp_seminar']=="2000") {echo "selected";}  ?>>2000</option>
                    <option value="1999" <?php if ($row['gmp_seminar']=="1999") {echo "selected";}  ?>>1999</option>
                    <option value="1998" <?php if ($row['gmp_seminar']=="1998") {echo "selected";}  ?>>1998</option>
                    <option value="1997" <?php if ($row['gmp_seminar']=="1997") {echo "selected";}  ?>>1997</option>
                    <option value="1996" <?php if ($row['gmp_seminar']=="1996") {echo "selected";}  ?>>1996</option>
                    <option value="1995" <?php if ($row['gmp_seminar']=="1995") {echo "selected";}  ?>>1995</option>
                    <option value="1994" <?php if ($row['gmp_seminar']=="1994") {echo "selected";}  ?>>1994</option>
                    <option value="1993" <?php if ($row['gmp_seminar']=="1993") {echo "selected";}  ?>>1993</option>
                    <option value="1992" <?php if ($row['gmp_seminar']=="1992") {echo "selected";}  ?>>1992</option>
                    <option value="1991" <?php if ($row['gmp_seminar']=="1991") {echo "selected";}  ?>>1991</option>
                    <option value="1990" <?php if ($row['gmp_seminar']=="1990") {echo "selected";}  ?>>1990</option>
                  </select>

                </div>

               

              </div>

    </div>

  </div> 




   <div class="row" style="margin-bottom: 15px;">

    <div class="col-md-6">

      <div class="box-body">

                <div class="form-group">

                  <label for="pld">Plant Layout Design</label>

                  <select name="pld" id="pld" class="form-control" >
                    <option value="---" <?php if ($row['plant_layout']=="---") {echo "selected";}  ?>>---</option>
                    <option value="N/A" <?php if ($row['plant_layout']=="N/A") {echo "selected";}  ?>>N/A</option>
                    <option value="Accomplished" <?php if ($row['plant_layout']=="Accomplished") {echo "selected";}  ?>>Accomplished</option>
                    <option value="2040" <?php if ($row['plant_layout']=="2040") {echo "selected";}  ?>>2040</option>
                    <option value="2039" <?php if ($row['plant_layout']=="2039") {echo "selected";}  ?>>2039</option>
                    <option value="2038" <?php if ($row['plant_layout']=="2038") {echo "selected";}  ?>>2038</option>
                    <option value="2037" <?php if ($row['plant_layout']=="2037") {echo "selected";}  ?>>2037</option>
                    <option value="2036" <?php if ($row['plant_layout']=="2036") {echo "selected";}  ?>>2036</option>
                    <option value="2035" <?php if ($row['plant_layout']=="2035") {echo "selected";}  ?>>2035</option>
                    <option value="2034" <?php if ($row['plant_layout']=="2034") {echo "selected";}  ?>>2034</option>
                    <option value="2033" <?php if ($row['plant_layout']=="2033") {echo "selected";}  ?>>2033</option>
                    <option value="2032" <?php if ($row['plant_layout']=="2032") {echo "selected";}  ?>>2032</option>
                    <option value="2031" <?php if ($row['plant_layout']=="2031") {echo "selected";}  ?>>2031</option>
                    <option value="2030" <?php if ($row['plant_layout']=="2030") {echo "selected";}  ?>>2030</option>
                    <option value="2029" <?php if ($row['plant_layout']=="2029") {echo "selected";}  ?>>2029</option>
                    <option value="2028" <?php if ($row['plant_layout']=="2028") {echo "selected";}  ?>>2028</option>
                    <option value="2027" <?php if ($row['plant_layout']=="2027") {echo "selected";}  ?>>2027</option>
                    <option value="2026" <?php if ($row['plant_layout']=="2026") {echo "selected";}  ?>>2026</option>
                    <option value="2025" <?php if ($row['plant_layout']=="2025") {echo "selected";}  ?>>2025</option>
                    <option value="2024" <?php if ($row['plant_layout']=="2024") {echo "selected";}  ?>>2024</option>
                    <option value="2023" <?php if ($row['plant_layout']=="2023") {echo "selected";}  ?>>2023</option>
                    <option value="2022" <?php if ($row['plant_layout']=="2022") {echo "selected";}  ?>>2022</option>
                    <option value="2021" <?php if ($row['plant_layout']=="2021") {echo "selected";}  ?>>2021</option>
                    <option value="2020" <?php if ($row['plant_layout']=="2020") {echo "selected";}  ?>>2020</option>
                    <option value="2019" <?php if ($row['plant_layout']=="2019") {echo "selected";}  ?>>2019</option>
                    <option value="2018" <?php if ($row['plant_layout']=="2018") {echo "selected";}  ?>>2018</option>
                    <option value="2017" <?php if ($row['plant_layout']=="2017") {echo "selected";}  ?>>2017</option>
                    <option value="2016" <?php if ($row['plant_layout']=="2016") {echo "selected";}  ?>>2016</option>
                    <option value="2015" <?php if ($row['plant_layout']=="2015") {echo "selected";}  ?>>2015</option>
                    <option value="2014" <?php if ($row['plant_layout']=="2014") {echo "selected";}  ?>>2014</option>
                    <option value="2013" <?php if ($row['plant_layout']=="2013") {echo "selected";}  ?>>2013</option>
                    <option value="2012" <?php if ($row['plant_layout']=="2012") {echo "selected";}  ?>>2012</option>
                    <option value="2011" <?php if ($row['plant_layout']=="2011") {echo "selected";}  ?>>2011</option>
                    <option value="2010" <?php if ($row['plant_layout']=="2010") {echo "selected";}  ?>>2010</option>
                    <option value="2009" <?php if ($row['plant_layout']=="2009") {echo "selected";}  ?>>2009</option>
                    <option value="2008" <?php if ($row['plant_layout']=="2008") {echo "selected";}  ?>>2008</option>
                    <option value="2007" <?php if ($row['plant_layout']=="2007") {echo "selected";}  ?>>2007</option>
                    <option value="2006" <?php if ($row['plant_layout']=="2006") {echo "selected";}  ?>>2006</option>
                    <option value="2005" <?php if ($row['plant_layout']=="2005") {echo "selected";}  ?>>2005</option>
                    <option value="2004" <?php if ($row['plant_layout']=="2004") {echo "selected";}  ?>>2004</option>
                    <option value="2003" <?php if ($row['plant_layout']=="2003") {echo "selected";}  ?>>2003</option>
                    <option value="2002" <?php if ($row['plant_layout']=="2002") {echo "selected";}  ?>>2002</option>
                    <option value="2001" <?php if ($row['plant_layout']=="2001") {echo "selected";}  ?>>2001</option>
                    <option value="2000" <?php if ($row['plant_layout']=="2000") {echo "selected";}  ?>>2000</option>
                    <option value="1999" <?php if ($row['plant_layout']=="1999") {echo "selected";}  ?>>1999</option>
                    <option value="1998" <?php if ($row['plant_layout']=="1998") {echo "selected";}  ?>>1998</option>
                    <option value="1997" <?php if ($row['plant_layout']=="1997") {echo "selected";}  ?>>1997</option>
                    <option value="1996" <?php if ($row['plant_layout']=="1996") {echo "selected";}  ?>>1996</option>
                    <option value="1995" <?php if ($row['plant_layout']=="1995") {echo "selected";}  ?>>1995</option>
                    <option value="1994" <?php if ($row['plant_layout']=="1994") {echo "selected";}  ?>>1994</option>
                    <option value="1993" <?php if ($row['plant_layout']=="1993") {echo "selected";}  ?>>1993</option>
                    <option value="1992" <?php if ($row['plant_layout']=="1992") {echo "selected";}  ?>>1992</option>
                    <option value="1991" <?php if ($row['plant_layout']=="1991") {echo "selected";}  ?>>1991</option>
                    <option value="1990" <?php if ($row['plant_layout']=="1990") {echo "selected";}  ?>>1990</option>
                  </select>

                </div>

               

              </div>

    </div>




    <div class="col-md-6">

      <div class="box-body">

                <div class="form-group">

                  <label for="gmpMan">Good Manufacturing Practices (<b>GMP</b>) Manual</label>

                  <select name="gmpMan" id="gmpMan" class="form-control" >
                    <option value="---" <?php if ($row['gmp_manual']=="---") {echo "selected";}  ?>>---</option>
                    <option value="N/A" <?php if ($row['gmp_manual']=="N/A") {echo "selected";}  ?>>N/A</option>
                    <option value="Accomplished" <?php if ($row['gmp_manual']=="Accomplished") {echo "selected";}  ?>>Accomplished</option>
                    <option value="2040" <?php if ($row['gmp_manual']=="2040") {echo "selected";}  ?>>2040</option>
                    <option value="2039" <?php if ($row['gmp_manual']=="2039") {echo "selected";}  ?>>2039</option>
                    <option value="2038" <?php if ($row['gmp_manual']=="2038") {echo "selected";}  ?>>2038</option>
                    <option value="2037" <?php if ($row['gmp_manual']=="2037") {echo "selected";}  ?>>2037</option>
                    <option value="2036" <?php if ($row['gmp_manual']=="2036") {echo "selected";}  ?>>2036</option>
                    <option value="2035" <?php if ($row['gmp_manual']=="2035") {echo "selected";}  ?>>2035</option>
                    <option value="2034" <?php if ($row['gmp_manual']=="2034") {echo "selected";}  ?>>2034</option>
                    <option value="2033" <?php if ($row['gmp_manual']=="2033") {echo "selected";}  ?>>2033</option>
                    <option value="2032" <?php if ($row['gmp_manual']=="2032") {echo "selected";}  ?>>2032</option>
                    <option value="2031" <?php if ($row['gmp_manual']=="2031") {echo "selected";}  ?>>2031</option>
                    <option value="2030" <?php if ($row['gmp_manual']=="2030") {echo "selected";}  ?>>2030</option>
                    <option value="2029" <?php if ($row['gmp_manual']=="2029") {echo "selected";}  ?>>2029</option>
                    <option value="2028" <?php if ($row['gmp_manual']=="2028") {echo "selected";}  ?>>2028</option>
                    <option value="2027" <?php if ($row['gmp_manual']=="2027") {echo "selected";}  ?>>2027</option>
                    <option value="2026" <?php if ($row['gmp_manual']=="2026") {echo "selected";}  ?>>2026</option>
                    <option value="2025" <?php if ($row['gmp_manual']=="2025") {echo "selected";}  ?>>2025</option>
                    <option value="2024" <?php if ($row['gmp_manual']=="2024") {echo "selected";}  ?>>2024</option>
                    <option value="2023" <?php if ($row['gmp_manual']=="2023") {echo "selected";}  ?>>2023</option>
                    <option value="2022" <?php if ($row['gmp_manual']=="2022") {echo "selected";}  ?>>2022</option>
                    <option value="2021" <?php if ($row['gmp_manual']=="2021") {echo "selected";}  ?>>2021</option>
                    <option value="2020" <?php if ($row['gmp_manual']=="2020") {echo "selected";}  ?>>2020</option>
                    <option value="2019" <?php if ($row['gmp_manual']=="2019") {echo "selected";}  ?>>2019</option>
                    <option value="2018" <?php if ($row['gmp_manual']=="2018") {echo "selected";}  ?>>2018</option>
                    <option value="2017" <?php if ($row['gmp_manual']=="2017") {echo "selected";}  ?>>2017</option>
                    <option value="2016" <?php if ($row['gmp_manual']=="2016") {echo "selected";}  ?>>2016</option>
                    <option value="2015" <?php if ($row['gmp_manual']=="2015") {echo "selected";}  ?>>2015</option>
                    <option value="2014" <?php if ($row['gmp_manual']=="2014") {echo "selected";}  ?>>2014</option>
                    <option value="2013" <?php if ($row['gmp_manual']=="2013") {echo "selected";}  ?>>2013</option>
                    <option value="2012" <?php if ($row['gmp_manual']=="2012") {echo "selected";}  ?>>2012</option>
                    <option value="2011" <?php if ($row['gmp_manual']=="2011") {echo "selected";}  ?>>2011</option>
                    <option value="2010" <?php if ($row['gmp_manual']=="2010") {echo "selected";}  ?>>2010</option>
                    <option value="2009" <?php if ($row['gmp_manual']=="2009") {echo "selected";}  ?>>2009</option>
                    <option value="2008" <?php if ($row['gmp_manual']=="2008") {echo "selected";}  ?>>2008</option>
                    <option value="2007" <?php if ($row['gmp_manual']=="2007") {echo "selected";}  ?>>2007</option>
                    <option value="2006" <?php if ($row['gmp_manual']=="2006") {echo "selected";}  ?>>2006</option>
                    <option value="2005" <?php if ($row['gmp_manual']=="2005") {echo "selected";}  ?>>2005</option>
                    <option value="2004" <?php if ($row['gmp_manual']=="2004") {echo "selected";}  ?>>2004</option>
                    <option value="2003" <?php if ($row['gmp_manual']=="2003") {echo "selected";}  ?>>2003</option>
                    <option value="2002" <?php if ($row['gmp_manual']=="2002") {echo "selected";}  ?>>2002</option>
                    <option value="2001" <?php if ($row['gmp_manual']=="2001") {echo "selected";}  ?>>2001</option>
                    <option value="2000" <?php if ($row['gmp_manual']=="2000") {echo "selected";}  ?>>2000</option>
                    <option value="1999" <?php if ($row['gmp_manual']=="1999") {echo "selected";}  ?>>1999</option>
                    <option value="1998" <?php if ($row['gmp_manual']=="1998") {echo "selected";}  ?>>1998</option>
                    <option value="1997" <?php if ($row['gmp_manual']=="1997") {echo "selected";}  ?>>1997</option>
                    <option value="1996" <?php if ($row['gmp_manual']=="1996") {echo "selected";}  ?>>1996</option>
                    <option value="1995" <?php if ($row['gmp_manual']=="1995") {echo "selected";}  ?>>1995</option>
                    <option value="1994" <?php if ($row['gmp_manual']=="1994") {echo "selected";}  ?>>1994</option>
                    <option value="1993" <?php if ($row['gmp_manual']=="1993") {echo "selected";}  ?>>1993</option>
                    <option value="1992" <?php if ($row['gmp_manual']=="1992") {echo "selected";}  ?>>1992</option>
                    <option value="1991" <?php if ($row['gmp_manual']=="1991") {echo "selected";}  ?>>1991</option>
                    <option value="1990" <?php if ($row['gmp_manual']=="1990") {echo "selected";}  ?>>1990</option>
                  </select>

                </div>

               

              </div>

    </div>

  </div> 




   <div class="row" style="margin-bottom: 15px;">

    <div class="col-md-6">

      <div class="box-body">

                <div class="form-group">

                  <label for="ea">Energy Audit (<b>EA</b>)</label>

                  <select name="ea" id="ea" class="form-control" >
                    <option value="---" <?php if ($row['ea']=="---") {echo "selected";}  ?>>---</option>
                    <option value="N/A" <?php if ($row['ea']=="N/A") {echo "selected";}  ?>>N/A</option>
                    <option value="Accomplished" <?php if ($row['ea']=="Accomplished") {echo "selected";}  ?>>Accomplished</option>
                    <option value="2040" <?php if ($row['ea']=="2040") {echo "selected";}  ?>>2040</option>
                    <option value="2039" <?php if ($row['ea']=="2039") {echo "selected";}  ?>>2039</option>
                    <option value="2038" <?php if ($row['ea']=="2038") {echo "selected";}  ?>>2038</option>
                    <option value="2037" <?php if ($row['ea']=="2037") {echo "selected";}  ?>>2037</option>
                    <option value="2036" <?php if ($row['ea']=="2036") {echo "selected";}  ?>>2036</option>
                    <option value="2035" <?php if ($row['ea']=="2035") {echo "selected";}  ?>>2035</option>
                    <option value="2034" <?php if ($row['ea']=="2034") {echo "selected";}  ?>>2034</option>
                    <option value="2033" <?php if ($row['ea']=="2033") {echo "selected";}  ?>>2033</option>
                    <option value="2032" <?php if ($row['ea']=="2032") {echo "selected";}  ?>>2032</option>
                    <option value="2031" <?php if ($row['ea']=="2031") {echo "selected";}  ?>>2031</option>
                    <option value="2030" <?php if ($row['ea']=="2030") {echo "selected";}  ?>>2030</option>
                    <option value="2029" <?php if ($row['ea']=="2029") {echo "selected";}  ?>>2029</option>
                    <option value="2028" <?php if ($row['ea']=="2028") {echo "selected";}  ?>>2028</option>
                    <option value="2027" <?php if ($row['ea']=="2027") {echo "selected";}  ?>>2027</option>
                    <option value="2026" <?php if ($row['ea']=="2026") {echo "selected";}  ?>>2026</option>
                    <option value="2025" <?php if ($row['ea']=="2025") {echo "selected";}  ?>>2025</option>
                    <option value="2024" <?php if ($row['ea']=="2024") {echo "selected";}  ?>>2024</option>
                    <option value="2023" <?php if ($row['ea']=="2023") {echo "selected";}  ?>>2023</option>
                    <option value="2022" <?php if ($row['ea']=="2022") {echo "selected";}  ?>>2022</option>
                    <option value="2021" <?php if ($row['ea']=="2021") {echo "selected";}  ?>>2021</option>
                    <option value="2020" <?php if ($row['ea']=="2020") {echo "selected";}  ?>>2020</option>
                    <option value="2019" <?php if ($row['ea']=="2019") {echo "selected";}  ?>>2019</option>
                    <option value="2018" <?php if ($row['ea']=="2018") {echo "selected";}  ?>>2018</option>
                    <option value="2017" <?php if ($row['ea']=="2017") {echo "selected";}  ?>>2017</option>
                    <option value="2016" <?php if ($row['ea']=="2016") {echo "selected";}  ?>>2016</option>
                    <option value="2015" <?php if ($row['ea']=="2015") {echo "selected";}  ?>>2015</option>
                    <option value="2014" <?php if ($row['ea']=="2014") {echo "selected";}  ?>>2014</option>
                    <option value="2013" <?php if ($row['ea']=="2013") {echo "selected";}  ?>>2013</option>
                    <option value="2012" <?php if ($row['ea']=="2012") {echo "selected";}  ?>>2012</option>
                    <option value="2011" <?php if ($row['ea']=="2011") {echo "selected";}  ?>>2011</option>
                    <option value="2010" <?php if ($row['ea']=="2010") {echo "selected";}  ?>>2010</option>
                    <option value="2009" <?php if ($row['ea']=="2009") {echo "selected";}  ?>>2009</option>
                    <option value="2008" <?php if ($row['ea']=="2008") {echo "selected";}  ?>>2008</option>
                    <option value="2007" <?php if ($row['ea']=="2007") {echo "selected";}  ?>>2007</option>
                    <option value="2006" <?php if ($row['ea']=="2006") {echo "selected";}  ?>>2006</option>
                    <option value="2005" <?php if ($row['ea']=="2005") {echo "selected";}  ?>>2005</option>
                    <option value="2004" <?php if ($row['ea']=="2004") {echo "selected";}  ?>>2004</option>
                    <option value="2003" <?php if ($row['ea']=="2003") {echo "selected";}  ?>>2003</option>
                    <option value="2002" <?php if ($row['ea']=="2002") {echo "selected";}  ?>>2002</option>
                    <option value="2001" <?php if ($row['ea']=="2001") {echo "selected";}  ?>>2001</option>
                    <option value="2000" <?php if ($row['ea']=="2000") {echo "selected";}  ?>>2000</option>
                    <option value="1999" <?php if ($row['ea']=="1999") {echo "selected";}  ?>>1999</option>
                    <option value="1998" <?php if ($row['ea']=="1998") {echo "selected";}  ?>>1998</option>
                    <option value="1997" <?php if ($row['ea']=="1997") {echo "selected";}  ?>>1997</option>
                    <option value="1996" <?php if ($row['ea']=="1996") {echo "selected";}  ?>>1996</option>
                    <option value="1995" <?php if ($row['ea']=="1995") {echo "selected";}  ?>>1995</option>
                    <option value="1994" <?php if ($row['ea']=="1994") {echo "selected";}  ?>>1994</option>
                    <option value="1993" <?php if ($row['ea']=="1993") {echo "selected";}  ?>>1993</option>
                    <option value="1992" <?php if ($row['ea']=="1992") {echo "selected";}  ?>>1992</option>
                    <option value="1991" <?php if ($row['ea']=="1991") {echo "selected";}  ?>>1991</option>
                    <option value="1990" <?php if ($row['ea']=="1990") {echo "selected";}  ?>>1990</option>
                  </select>

                </div>

               

              </div>

    </div>




    <div class="col-md-6">

      <div class="box-body">

                <div class="form-group">

                  <label for="pcklbl">Packaging & Labeling</label>

                  <select name="pcklbl" id="pcklbl" class="form-control" >
                    <option value="---" <?php if ($row['packaging_labeling']=="---") {echo "selected";}  ?>>---</option>
                    <option value="N/A" <?php if ($row['packaging_labeling']=="N/A") {echo "selected";}  ?>>N/A</option>
                    <option value="Accomplished" <?php if ($row['packaging_labeling']=="Accomplished") {echo "selected";}  ?>>Accomplished</option>
                    <option value="2040" <?php if ($row['packaging_labeling']=="2040") {echo "selected";}  ?>>2040</option>
                    <option value="2039" <?php if ($row['packaging_labeling']=="2039") {echo "selected";}  ?>>2039</option>
                    <option value="2038" <?php if ($row['packaging_labeling']=="2038") {echo "selected";}  ?>>2038</option>
                    <option value="2037" <?php if ($row['packaging_labeling']=="2037") {echo "selected";}  ?>>2037</option>
                    <option value="2036" <?php if ($row['packaging_labeling']=="2036") {echo "selected";}  ?>>2036</option>
                    <option value="2035" <?php if ($row['packaging_labeling']=="2035") {echo "selected";}  ?>>2035</option>
                    <option value="2034" <?php if ($row['packaging_labeling']=="2034") {echo "selected";}  ?>>2034</option>
                    <option value="2033" <?php if ($row['packaging_labeling']=="2033") {echo "selected";}  ?>>2033</option>
                    <option value="2032" <?php if ($row['packaging_labeling']=="2032") {echo "selected";}  ?>>2032</option>
                    <option value="2031" <?php if ($row['packaging_labeling']=="2031") {echo "selected";}  ?>>2031</option>
                    <option value="2030" <?php if ($row['packaging_labeling']=="2030") {echo "selected";}  ?>>2030</option>
                    <option value="2029" <?php if ($row['packaging_labeling']=="2029") {echo "selected";}  ?>>2029</option>
                    <option value="2028" <?php if ($row['packaging_labeling']=="2028") {echo "selected";}  ?>>2028</option>
                    <option value="2027" <?php if ($row['packaging_labeling']=="2027") {echo "selected";}  ?>>2027</option>
                    <option value="2026" <?php if ($row['packaging_labeling']=="2026") {echo "selected";}  ?>>2026</option>
                    <option value="2025" <?php if ($row['packaging_labeling']=="2025") {echo "selected";}  ?>>2025</option>
                    <option value="2024" <?php if ($row['packaging_labeling']=="2024") {echo "selected";}  ?>>2024</option>
                    <option value="2023" <?php if ($row['packaging_labeling']=="2023") {echo "selected";}  ?>>2023</option>
                    <option value="2022" <?php if ($row['packaging_labeling']=="2022") {echo "selected";}  ?>>2022</option>
                    <option value="2021" <?php if ($row['packaging_labeling']=="2021") {echo "selected";}  ?>>2021</option>
                    <option value="2020" <?php if ($row['packaging_labeling']=="2020") {echo "selected";}  ?>>2020</option>
                    <option value="2019" <?php if ($row['packaging_labeling']=="2019") {echo "selected";}  ?>>2019</option>
                    <option value="2018" <?php if ($row['packaging_labeling']=="2018") {echo "selected";}  ?>>2018</option>
                    <option value="2017" <?php if ($row['packaging_labeling']=="2017") {echo "selected";}  ?>>2017</option>
                    <option value="2016" <?php if ($row['packaging_labeling']=="2016") {echo "selected";}  ?>>2016</option>
                    <option value="2015" <?php if ($row['packaging_labeling']=="2015") {echo "selected";}  ?>>2015</option>
                    <option value="2014" <?php if ($row['packaging_labeling']=="2014") {echo "selected";}  ?>>2014</option>
                    <option value="2013" <?php if ($row['packaging_labeling']=="2013") {echo "selected";}  ?>>2013</option>
                    <option value="2012" <?php if ($row['packaging_labeling']=="2012") {echo "selected";}  ?>>2012</option>
                    <option value="2011" <?php if ($row['packaging_labeling']=="2011") {echo "selected";}  ?>>2011</option>
                    <option value="2010" <?php if ($row['packaging_labeling']=="2010") {echo "selected";}  ?>>2010</option>
                    <option value="2009" <?php if ($row['packaging_labeling']=="2009") {echo "selected";}  ?>>2009</option>
                    <option value="2008" <?php if ($row['packaging_labeling']=="2008") {echo "selected";}  ?>>2008</option>
                    <option value="2007" <?php if ($row['packaging_labeling']=="2007") {echo "selected";}  ?>>2007</option>
                    <option value="2006" <?php if ($row['packaging_labeling']=="2006") {echo "selected";}  ?>>2006</option>
                    <option value="2005" <?php if ($row['packaging_labeling']=="2005") {echo "selected";}  ?>>2005</option>
                    <option value="2004" <?php if ($row['packaging_labeling']=="2004") {echo "selected";}  ?>>2004</option>
                    <option value="2003" <?php if ($row['packaging_labeling']=="2003") {echo "selected";}  ?>>2003</option>
                    <option value="2002" <?php if ($row['packaging_labeling']=="2002") {echo "selected";}  ?>>2002</option>
                    <option value="2001" <?php if ($row['packaging_labeling']=="2001") {echo "selected";}  ?>>2001</option>
                    <option value="2000" <?php if ($row['packaging_labeling']=="2000") {echo "selected";}  ?>>2000</option>
                    <option value="1999" <?php if ($row['packaging_labeling']=="1999") {echo "selected";}  ?>>1999</option>
                    <option value="1998" <?php if ($row['packaging_labeling']=="1998") {echo "selected";}  ?>>1998</option>
                    <option value="1997" <?php if ($row['packaging_labeling']=="1997") {echo "selected";}  ?>>1997</option>
                    <option value="1996" <?php if ($row['packaging_labeling']=="1996") {echo "selected";}  ?>>1996</option>
                    <option value="1995" <?php if ($row['packaging_labeling']=="1995") {echo "selected";}  ?>>1995</option>
                    <option value="1994" <?php if ($row['packaging_labeling']=="1994") {echo "selected";}  ?>>1994</option>
                    <option value="1993" <?php if ($row['packaging_labeling']=="1993") {echo "selected";}  ?>>1993</option>
                    <option value="1992" <?php if ($row['packaging_labeling']=="1992") {echo "selected";}  ?>>1992</option>
                    <option value="1991" <?php if ($row['packaging_labeling']=="1991") {echo "selected";}  ?>>1991</option>
                    <option value="1990" <?php if ($row['packaging_labeling']=="1990") {echo "selected";}  ?>>1990</option>
                  </select>

                </div>

               

              </div>

    </div>

  </div> 




   <div class="row" style="margin-bottom: 15px;">

    <div class="col-md-6">

      <div class="box-body">

                <div class="form-group">

                  <label for="campi">Consultancy for Agricultural and Manufacturing Productivity Improvement (<b>CAMPI</b>)</label>

                  <select name="campi" id="campi" class="form-control" >
                    <option value="---" <?php if ($row['campi']=="---") {echo "selected";}  ?>>---</option>
                    <option value="N/A" <?php if ($row['campi']=="N/A") {echo "selected";}  ?>>N/A</option>
                    <option value="Accomplished" <?php if ($row['campi']=="Accomplished") {echo "selected";}  ?>>Accomplished</option>
                    <option value="2040" <?php if ($row['campi']=="2040") {echo "selected";}  ?>>2040</option>
                    <option value="2039" <?php if ($row['campi']=="2039") {echo "selected";}  ?>>2039</option>
                    <option value="2038" <?php if ($row['campi']=="2038") {echo "selected";}  ?>>2038</option>
                    <option value="2037" <?php if ($row['campi']=="2037") {echo "selected";}  ?>>2037</option>
                    <option value="2036" <?php if ($row['campi']=="2036") {echo "selected";}  ?>>2036</option>
                    <option value="2035" <?php if ($row['campi']=="2035") {echo "selected";}  ?>>2035</option>
                    <option value="2034" <?php if ($row['campi']=="2034") {echo "selected";}  ?>>2034</option>
                    <option value="2033" <?php if ($row['campi']=="2033") {echo "selected";}  ?>>2033</option>
                    <option value="2032" <?php if ($row['campi']=="2032") {echo "selected";}  ?>>2032</option>
                    <option value="2031" <?php if ($row['campi']=="2031") {echo "selected";}  ?>>2031</option>
                    <option value="2030" <?php if ($row['campi']=="2030") {echo "selected";}  ?>>2030</option>
                    <option value="2029" <?php if ($row['campi']=="2029") {echo "selected";}  ?>>2029</option>
                    <option value="2028" <?php if ($row['campi']=="2028") {echo "selected";}  ?>>2028</option>
                    <option value="2027" <?php if ($row['campi']=="2027") {echo "selected";}  ?>>2027</option>
                    <option value="2026" <?php if ($row['campi']=="2026") {echo "selected";}  ?>>2026</option>
                    <option value="2025" <?php if ($row['campi']=="2025") {echo "selected";}  ?>>2025</option>
                    <option value="2024" <?php if ($row['campi']=="2024") {echo "selected";}  ?>>2024</option>
                    <option value="2023" <?php if ($row['campi']=="2023") {echo "selected";}  ?>>2023</option>
                    <option value="2022" <?php if ($row['campi']=="2022") {echo "selected";}  ?>>2022</option>
                    <option value="2021" <?php if ($row['campi']=="2021") {echo "selected";}  ?>>2021</option>
                    <option value="2020" <?php if ($row['campi']=="2020") {echo "selected";}  ?>>2020</option>
                    <option value="2019" <?php if ($row['campi']=="2019") {echo "selected";}  ?>>2019</option>
                    <option value="2018" <?php if ($row['campi']=="2018") {echo "selected";}  ?>>2018</option>
                    <option value="2017" <?php if ($row['campi']=="2017") {echo "selected";}  ?>>2017</option>
                    <option value="2016" <?php if ($row['campi']=="2016") {echo "selected";}  ?>>2016</option>
                    <option value="2015" <?php if ($row['campi']=="2015") {echo "selected";}  ?>>2015</option>
                    <option value="2014" <?php if ($row['campi']=="2014") {echo "selected";}  ?>>2014</option>
                    <option value="2013" <?php if ($row['campi']=="2013") {echo "selected";}  ?>>2013</option>
                    <option value="2012" <?php if ($row['campi']=="2012") {echo "selected";}  ?>>2012</option>
                    <option value="2011" <?php if ($row['campi']=="2011") {echo "selected";}  ?>>2011</option>
                    <option value="2010" <?php if ($row['campi']=="2010") {echo "selected";}  ?>>2010</option>
                    <option value="2009" <?php if ($row['campi']=="2009") {echo "selected";}  ?>>2009</option>
                    <option value="2008" <?php if ($row['campi']=="2008") {echo "selected";}  ?>>2008</option>
                    <option value="2007" <?php if ($row['campi']=="2007") {echo "selected";}  ?>>2007</option>
                    <option value="2006" <?php if ($row['campi']=="2006") {echo "selected";}  ?>>2006</option>
                    <option value="2005" <?php if ($row['campi']=="2005") {echo "selected";}  ?>>2005</option>
                    <option value="2004" <?php if ($row['campi']=="2004") {echo "selected";}  ?>>2004</option>
                    <option value="2003" <?php if ($row['campi']=="2003") {echo "selected";}  ?>>2003</option>
                    <option value="2002" <?php if ($row['campi']=="2002") {echo "selected";}  ?>>2002</option>
                    <option value="2001" <?php if ($row['campi']=="2001") {echo "selected";}  ?>>2001</option>
                    <option value="2000" <?php if ($row['campi']=="2000") {echo "selected";}  ?>>2000</option>
                    <option value="1999" <?php if ($row['campi']=="1999") {echo "selected";}  ?>>1999</option>
                    <option value="1998" <?php if ($row['campi']=="1998") {echo "selected";}  ?>>1998</option>
                    <option value="1997" <?php if ($row['campi']=="1997") {echo "selected";}  ?>>1997</option>
                    <option value="1996" <?php if ($row['campi']=="1996") {echo "selected";}  ?>>1996</option>
                    <option value="1995" <?php if ($row['campi']=="1995") {echo "selected";}  ?>>1995</option>
                    <option value="1994" <?php if ($row['campi']=="1994") {echo "selected";}  ?>>1994</option>
                    <option value="1993" <?php if ($row['campi']=="1993") {echo "selected";}  ?>>1993</option>
                    <option value="1992" <?php if ($row['campi']=="1992") {echo "selected";}  ?>>1992</option>
                    <option value="1991" <?php if ($row['campi']=="1991") {echo "selected";}  ?>>1991</option>
                    <option value="1990" <?php if ($row['campi']=="1990") {echo "selected";}  ?>>1990</option>
                  </select>

                </div>

               

              </div>

    </div>



  </div> 





    <div class="row" style="margin-bottom: 15px;">

    <div class="col-md-12">

              <div class="box-body">

          <button style="width: 157px; height: 46px;" type="submit" form="upd" name="submButton" id="submButton" class="btn btn-block btn-warning btn-lg">Update</button>

            <!-- <button style="width: 157px; height: 46px; color: white;" type="button" class="btn btn-block btn-warning btn-lg">Restart</button> -->

          </div>

      </div>

    </div>



<div class="box-footer"></div>
</div>
</form>



<div class="alert alert-danger alert-dismissible" id="upError" style="display: none;">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-ban" style=" padding: 20px;"></i> Error!</h4>Failed to upload file! File already exist in the server. Please rename the file if it is different from the previously uploaded one.

</div>

<div class="alert alert-success alert-dismissible" id="upSuccess" style="display: none;">
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check" style=" padding: 0px;"></i> Success!</h4> File successfully uploaded!

</div>

<div class="alert alert-success alert-dismissible" id="delSuccess" style="display: none;">
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check" style=" padding: 0px;"></i> Success!</h4> File successfully deleted!

</div>

<div class="box box-danger" id="upHere">

            <div class="box-header with-border">

              <h3 class="box-title">Upload File</h3>

            </div>

    <div class="row" style="margin-bottom: 15px;">

    </div>

<form action="update.php?id=<?php echo $id; ?>#upHere" method="POST" name="uploadForm" id="uploadForm" enctype="multipart/form-data"></form>
  <div class="row" style="margin-bottom: 15px;">


    <div class="col-md-6" >
      <div class="box-body">
        <div class="form-group">
            <label>Uploaded File(s)</label>
            <br>
            <?php 
              $query=mysqli_query($mysqli,"SELECT * FROM `upload_files` WHERE `ben_id` = '$id'");
              $printOut = "";
              while ($rowq = $query->fetch_assoc())  {
                $printOut.= '<a id="'.$rowq['id'].'" class="btn btn-danger btn-sm" style="margin-bottom: 3px;" onclick="removeFile(\''.$rowq['id'].'\');" >Delete</a><a href="'.$rowq['url'].'" style="border-bottom: solid 1px #dd4b39; padding: 3px; font-size: 20px;">'.$rowq['file_name'].' </a>
                  <br>';
              };
              echo $printOut;
            ?>
            
        </div>
      </div>
    </div>

    <div class="col-md-6" >
      <div class="box-body" id="upfile">
        <div class="form-group">
            <label>Upload File Here</label>
            <input type="file" form="uploadForm" name="a-contentFile" id="a-contentFile" required>
            <br>
            <button type="submit" name="submUpload" form="uploadForm" class="btn btn-block btn-success" style="width: 178px;">Submit</button>
        </div>
      </div>
    </div>

  </div>
<div class="box-footer"></div>

</div>


</section>
</div>

  <!-- /.content-wrapper -->

  <footer class="main-footer">

   <!--  <div class="pull-right hidden-xs">

      <b>Version</b> 1.0.0

    </div>

    <strong>Copyright &copy; 2019 <a href="https://facebook.com/iTechnoFest2019">USeP - Society of Information Technology Students</a>.</strong> All rights

    reserved. -->

  </footer>





</div>
</form>
<!-- ./wrapper -->



<!-- jQuery 3 -->

<script src="bower_components/jquery/dist/jquery.min.js"></script>

<!-- jQuery UI 1.11.4 -->

<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<script>

  $.widget.bridge('uibutton', $.ui.button);

</script>

<!-- Bootstrap 3.3.7 -->

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Morris.js charts -->

<script src="bower_components/raphael/raphael.min.js"></script>

<script src="bower_components/morris.js/morris.min.js"></script>

<!-- Sparkline -->

<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>

<!-- jvectormap -->

<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>

<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<!-- jQuery Knob Chart -->

<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>

<!-- daterangepicker -->

<script src="bower_components/moment/min/moment.min.js"></script>

<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- datepicker -->

<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- Bootstrap WYSIHTML5 -->

<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<!-- Slimscroll -->

<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<!-- FastClick -->

<script src="bower_components/fastclick/lib/fastclick.js"></script>

<!-- AdminLTE App -->

<script src="dist/js/adminlte.min.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<script src="dist/js/pages/dashboard.js"></script>

<!-- AdminLTE for demo purposes -->

<script src="dist/js/demo.js"></script>





<script type="text/javascript">

function removeFile(x) {
  if (confirm("Are you sure you want to remove this file? This action CANNOT be undone.")) 
  {
    var a = '#' + x;
    var file_name = $(a).next("a").text();
    var id = "<?php echo $id ?>";

    location.replace("update.php?rdid=" + file_name + "&id=" + id + "#upHere");
  }
  else
  {

  }
}
 
function redirect() {
  location.replace("masterlist.php");
}

</script>



<script type="text/javascript">

  var flag = "<?php echo $flag ?>";

  if (flag == "0"){
    

  }

  else if (flag == "success"){

    document.getElementById("success").style.display = "block";

  }

  else if (flag == "upSuccess"){

    document.getElementById("upSuccess").style.display = "block";

  }

  else if (flag == "upError"){

    document.getElementById("upError").style.display = "block";

  }

  else if (flag == "delSuccess"){

    document.getElementById("delSuccess").style.display = "block";

  }

</script>










</body>

</html>

