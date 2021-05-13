<?php
 include_once 'connection.php';
session_start();
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />
	<title>AdminKit Demo - Bootstrap 5 Admin Template</title>
	<link href="../main/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>	 

	<div class="wrapper"> 
	<?php include '../main/nav.php'; ?>  
		<div class="main">
		  
			<main class="content">
				<div class="container-fluid p-0">
			 
                <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">

                        </div>
                        <div class="iq-card-body">
                            <div id="table" class="table-editable">
                                <span class="table-add float-right mb-3 mr-2">
                                    <a class="btn btn-primary rounded-pill" href="customer.php"> create </a>
                                </span>
                                <table class="table table-bordered table-responsive-md table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th> ID</th>
                                            <th>Title</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th> Last Name</th>
                                            <th>Contact Number</th>
                                            <th>District</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        <?php
    $sql = 'SELECT * FROM customer';
    $query = $dbh->prepare($sql);
      $query->execute();
      $results = $query->fetchAll(PDO::FETCH_OBJ);
if ($query->rowCount() > 0) {
    foreach ($results as $result) {
        ?>
                                        <tr>
                                            <td class="text-dark"><?php echo $result->id; ?></td>
                                            <td class="text-dark"><?php echo $result->title; ?></td>
                                            <td class="text-dark"><?php echo $result->first_name; ?></td>
                                            <td class="text-dark"><?php echo $result->middle_name; ?></td>
                                            <td class="text-dark"><?php echo $result->last_name; ?></td>
                                            <td class="text-dark"><?php echo $result->contact_no; ?></td>
                                            <td class="text-dark"><?php echo $result->district; ?> </td>
                                            <td>   
                                            <span class="table-add float-right mb-3 mr-2">


                                            <?php

    if (isset($_REQUEST['delete_id'])) {
        // select image from db to delete
        $id = $_REQUEST['delete_id'];	//get delete_id and store in $id variable

        $select_stmt = $dbh->prepare('SELECT * FROM customer WHERE id=:id');	//sql select query
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        //delete an orignal record from db
        $delete_stmt = $dbh->prepare('DELETE FROM customer WHERE id=:id');
        $delete_stmt->bindParam(':id', $id);
        $delete_stmt->execute();
 
    } ?>
                                            
                                            <a href="customerview.php?delete_id=<?php echo $result->id; ?>" class="btn btn-danger">Delete</a  >
                                </span>
                                            <span class="table-add float-right mb-3 mr-2">
                                    <a class="btn btn-primary rounded-pill" href="customer_edit.php?id=<?php echo $result->id; ?>"> Edit </a>
                                </span>
                               </td>
                                        </tr>
                                        <?php
    }
}?>
                                        </td>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
				</div>
			</main>	
		</div>
	</div>

	<script src="../main/js/app.js"></script>

 
 

</body>

</html>

 
 