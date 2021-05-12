


<?php

include_once 'connection.php';

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $contact_no = $_POST['contact_no'];
    $district = $_POST['district'];

    $sql = 'INSERT INTO  `customer`(`title`,`first_name`,`middle_name`,`last_name`,`contact_no`,`district`)VALUES(:title,:first_name,:middle_name,:last_name,:contact_no,:district)';
    $query = $dbh->prepare($sql);
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->bindParam(':first_name', $first_name, PDO::PARAM_STR);
    $query->bindParam(':middle_name', $middle_name, PDO::PARAM_STR);
    $query->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $query->bindParam(':contact_no', $contact_no, PDO::PARAM_STR);
    $query->bindParam(':district', $district, PDO::PARAM_STR);

    $query->execute();
    header('location:customer.php');
}

 ?>

<!DOCTYPE html>
<html>
<head>
<title>customer details</title>
 <!-- Boostrap Link ******************************************************************************************************************** -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<!-- Boostrap link ******************************************************************************************************************** -->
  
 
 <style type="text/css">
   .wrapper{

    margin-right:20rem;
   }
   .span8{
margin-left: 20rem;

   }
 </style>
</head>
<body>

<div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="iq-card-body">
                </div>
            </div>
            <div class="iq-card">
                <div class="iq-card-body">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title"></h4>
                        </div>
                    </div>
                    <form action=" "  name="insert" method="POST" >
                       
                        <div class="form-group">
                            <label  >title</label>
                         
                                <select name="title" id="title" class="form-control">
                                    <option value="Miss.">Miss </option>
                                    <option value="MRS.">MRS</option>
                                    <option value="MR">MR</option>
                                </select>
                           
                        </div>
                        <div class="form-group">
                            <label  >First Name</label>
                            <input type="text" class="form-control" name="first_name" id=" first_name">
                        </div>
                        <div class="form-group">
                            <label  >Middle Name</label>
                            <input type="text" class="form-control" name=" middle_name" id="middle_name ">
                        </div>
                        <div class="form-group">
                            <label  >Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="last_name ">
                        </div>
                        <div class="form-group">
                            <label  >Contact No</label>
                            <input type="text" class="form-control" name="contact_no" id=" contact_no">
                        </div>
                      
             

             <div class="form-group">
                            <label>District</label>
                            <select name="district" class="form-control">
                            <?php
    $sql = 'SELECT * FROM district';
    $query = $dbh->prepare($sql);
      $query->execute();
      $results = $query->fetchAll(PDO::FETCH_OBJ);
if ($query->rowCount() > 0) {
    foreach ($results as $result) {
        ?>
               
                                        <option value="<?php echo $result->id; ?>"><?php echo $result->district; ?></option>
                                        <?php
    }
}?>
      
    
 
                            </select>
                        </div>
                       
                   
                        <input type="submit" value="Send" name="submit"    type="button" class="btn btn-dark" />
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
   
 
 	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
</body>
</html>