<?php

require_once 'connection.php';

if (isset($_REQUEST['id'])) {
    try {
        $id = $_REQUEST['id']; //get "update_id" from index.php page through anchor tag operation and store in "$id" variable
    $query = $dbh->prepare('SELECT * FROM customer WHERE id=:id'); //sql select query
    $query->bindParam(':id', $id);

        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        extract($result);
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

if (isset($_REQUEST['btn_update'])) {
    try {
        $id = $_REQUEST['id'];
        $title = $_REQUEST['title'];
        $first_name = $_REQUEST['first_name'];
        $middle_name = $_REQUEST['middle_name'];
        $last_name = $_REQUEST['last_name'];
        $contact_no = $_REQUEST['contact_no'];
        $district = $_REQUEST['district'];
        if (!isset($errorMsg)) {
            $query = $dbh->prepare('UPDATE customer SET title=:title,first_name=:first_name,middle_name=:middle_name,last_name=:last_name,contact_no=:contact_no,district=:district WHERE id=:id'); //sql update query
            $query->bindParam(':title', $title);
            $query->bindParam(':first_name', $first_name);
            $query->bindParam(':middle_name', $middle_name);
            $query->bindParam(':last_name', $last_name);
            $query->bindParam(':contact_no', $contact_no);
            //bind all parameter
            $query->bindParam(':district', $district);
            $query->bindParam(':id', $id);
            if ($query->execute()) {
                $updateMsg = 'File Update Successfully.......';
                header('refresh:3;customerview.php');
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<title>PHP PDO File Upload Using MySQL:onlyxscript.blogspot.in</title>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
</head>
<style type="text/css">
  

form{
  width: 50rem;
  height: 50rem;
  margin-left: 20REM;
}

</style>
  <body>
  
 
  <div class="wrapper">
  
  <div class="container">
      
    <div class="col-lg-12">
    
    <?php
    if (isset($errorMsg)) {
        ?>
            <div class="alert alert-danger">
              <strong>WRONG ! <?php echo $errorMsg; ?></strong>
            </div>
            <?php
    }
    if (isset($updateMsg)) {
        ?>
      <div class="alert alert-success">
        <strong>UPDATE ! <?php echo $updateMsg; ?></strong>
      </div>
        <?php
    }
    ?>  
    
   
             
        
          
          
        
          
          
        
    
   

         


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
                    <form method="post" class="form-horizontal" enctype="multipart/form-data">
                       
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
                            <input type="text" class="form-control" name="first_name" id=" first_name" value=" <?php echo $first_name; ?>">
                        </div>
                        <div class="form-group">
                            <label  >Middle Name</label>
                            <input type="text" class="form-control" name=" middle_name" id="middle_name " value=" <?php echo $middle_name; ?>">
                        </div>
                        <div class="form-group">
                            <label  >Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="last_name " value=" <?php echo $last_name; ?>">
                        </div>
                        <div class="form-group">
                            <label  >Contact No</label>
                            <input type="text" class="form-control" name="contact_no" id=" contact_no" value=" <?php echo $contact_no; ?>">
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
                       
                   
                        <input type="submit"  name="btn_update" class="btn btn-primary" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
   
 
   
       
      </form>
      
    </div>
    
  </div>
      
  </div>
                    
  </body>
</html>