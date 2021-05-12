<?php
 include_once 'connection.php';
session_start();
 ?>
<!DOCTYPE html>
<html>

<head>
    <title> Customer data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

</head>

<body>




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

        header('Location:customerview.php');
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
</body>

</html>>