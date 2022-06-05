<?php
include_once 'header.php';
include_once 'app/RequestAction.php';
$requestAction = new RequestAction();
if(isset($_GET['action'])){
    $action = $_GET['action'];
    if($action == 'viewRecords'){
     $records =  $requestAction->ViewRecords();
  
     include_once 'app\view\viewRecords.php';
 
    }else if($action == 'searchRecords'){
        $errors = [];
        include_once 'app/view/SearchRecords.php';
        
        if (isset($_POST['search'])) {
         
            //validation
            if (isset($_POST['keyword'])) {//设定keyword的输入规范
                $keyword = $_POST['keyword'];
                if (strlen($keyword) == 0) {
                    $errors['keyword'] = 'keyword is missing input';
                }

                else {
                  $records = $requestAction->searchRecords($keyword); 
                  include_once("app/view/viewRecords.php");
                    }
                   
                }
            } else {
                include_once 'app/view/SearchRecords.php'; //有不符合规范的就返回form并提示
            }
        }else if($action == 'addRecords'){
           
           
            include_once 'app/view/addRecords.php';
            $firs_tname = '';
            $last_name = '';
            $email = '';
             $booking_date = '1970-01-01';
             $booking_time = '00:00:00';
            $num_people = 0;
            $filename = '';
            $errors = [];
            if(isset($_POST['add'])){
               
            if (isset($_POST['first_name'])) {//设定first_name的输入规范
                $first_name = $_POST['first_name'];
                echo "<script>alert('$first_name')</script>";
                if (strlen($first_name) == 0) {
                    $errors['first_name'] = 'First Name is missing input';
                    echo "<script>alert('first name miss input')</script>";
                } elseif (!ctype_alpha($first_name)) {
                    $errors['first_name'] = 'Enter a valid First Name';
                    echo "<script>alert('fisst name invalid)</script>";
                }
            }

            if (isset($_POST['last_name'])) {//设定last_name的输入规范
                $last_name = $_POST['last_name'];
                if (strlen($last_name) == 0) {
                    $errors['last_name'] = 'Last Name is missing input';
                    echo "<script>alert('last name miss input')</script>";
                } elseif (!ctype_alpha($last_name)) {
                    $errors['last_name'] = 'Enter a valid Last Name';
                    echo "<script>alert('invalid lastname')</script>";
                }
            }

            if (isset($_POST['email'])) {//设定email的输入规范
                $email = trim($_POST['email']);
                if (strlen($email) == 0) {
                    $errors['email'] = "Email address is missing input";
                    echo "<script>alert('email miss input')</script>";
                } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = "Enter a valid Email Address";
                    echo "<script>alert('email invalid')</script>";
                }
            }

            if (isset($_POST['booking_date'])) {
                $booking_date =($_POST['booking_date']);
                if (strlen($booking_date) == 0) {
                    $errors['booking_date'] = "Missing input";
                    echo "<script>alert('date miss input')</script>";
                } 
            }
            if (isset($_POST['booking_time'])) {
                $booking_time = ($_POST['booking_time']);
                if (strlen($booking_time) == 0) {
                    $errors['book_time'] = "Missing input";
                    echo "<script>alert('time miss input')</script>";
                } 
            }
            if (isset($_POST['num_people'])) {
                $num_people = ($_POST['num_people']);
                if (strlen($num_people) == 0) {
                    $errors['num_people'] = "Missing input";
                    echo "<script>alert('num miss input')</script>";
                } 
            }
            $c = count($errors);
         
           
            // image 
            $filename = $_FILES["image"]["name"];
            $temp_file = $_FILES["image"]["tmp_name"];
            $type = $_FILES["image"]["type"];
            $size = $_FILES["image"]["size"];
            $errorLevel = $_FILES["image"]["error"];

            $error_messages = [
                "Upload successful",
                "File exceeds maximum upload size specified by default",
                "File exceeds size specified by MAX_FILE_SIZE",
                "File only partially uploaded",
                "Form submitted with no file specified",
                "",
                "No temporary folder",
                "Cannot write file to disk",
                "File type is not permitted"
            ];

            $destination = 'static/assets/photos/';
            $target_file = $destination . $filename;
            $max = 3000000;
            $record = compact("first_name", "last_name", "email","booking_date","booking_time","num_people","filename");

            if ($errorLevel > 0) {
                // Set the error message to the errors array        
                $errors["image"] = $error_messages[$errorLevel];
            } else {
                if (file_exists($temp_file)) {
                    $size = $_FILES["image"]["size"];
                    if ($size <= $max) {
                        $permitted = ["gif", "jpg", "jpeg", "png"];
                        $ext = pathinfo($filename, PATHINFO_EXTENSION);
                        if (in_array($ext, $permitted)) {
                            move_uploaded_file($temp_file, $target_file);
                            //$errors["image"] = "The file $filename has been uploaded.";
                        } else {
                            $errors["image"] = "$filename type is not permitted";
                        }
                    } else {
                        $errors["image"] = "$filename is too big – upload failed";
                    }
                } else {
                    $errors["image"] = "File upload has failed";
                }
            }
         
            if (count($errors) == 0) {
               
                $requestAction->addRecord($record);
               
            } else {
                include_once 'app\view\addRecords.php'; //有不符合规范的就返回form并提示
            }
        }
        } 
        else if($action == 'editRecords') 
        {
        $booking_id = $_GET['booking_id'];
        $first_name = $_GET['first_name'];
        $last_name = $_GET['last_name'];
        $email = $_GET['email'];
        $booking_date = $_GET['booking_date'];
        $booking_time = $_GET['booking_time'];
        $num_people = $_GET['num_people'];
        $filename = $_GET['filename'];
            include 'app/view/editRecords.php';
            $errors = [];
            if(isset($_POST['update'])){
               
            if (isset($_POST['first_name'])) {//设定first_name的输入规范
                $first_name = $_POST['first_name'];
                echo "<script>alert('$first_name')</script>";
                if (strlen($first_name) == 0) {
                    $errors['first_name'] = 'First Name is missing input';
                    echo "<script>alert('first name miss input')</script>";
                } elseif (!ctype_alpha($first_name)) {
                    $errors['first_name'] = 'Enter a valid First Name';
                    echo "<script>alert('fisst name invalid)</script>";
                }
            }

            if (isset($_POST['last_name'])) {//设定last_name的输入规范
                $last_name = $_POST['last_name'];
                if (strlen($last_name) == 0) {
                    $errors['last_name'] = 'Last Name is missing input';
                    echo "<script>alert('last name miss input')</script>";
                } elseif (!ctype_alpha($last_name)) {
                    $errors['last_name'] = 'Enter a valid Last Name';
                    echo "<script>alert('invalid lastname')</script>";
                }
            }

            if (isset($_POST['email'])) {//设定email的输入规范
                $email = trim($_POST['email']);
                if (strlen($email) == 0) {
                    $errors['email'] = "Email address is missing input";
                    echo "<script>alert('email miss input')</script>";
                } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = "Enter a valid Email Address";
                    echo "<script>alert('email invalid')</script>";
                }
            }

            if (isset($_POST['booking_date'])) {
                $booking_date =($_POST['booking_date']);
                if (strlen($booking_date) == 0) {
                    $errors['booking_date'] = "Missing input";
                    echo "<script>alert('date miss input')</script>";
                } 
            }
            if (isset($_POST['booking_time'])) {
                $booking_time = ($_POST['booking_time']);
                if (strlen($booking_time) == 0) {
                    $errors['book_time'] = "Missing input";
                    echo "<script>alert('time miss input')</script>";
                } 
            }
            if (isset($_POST['num_people'])) {
                $num_people = ($_POST['num_people']);
                if (strlen($num_people) == 0) {
                    $errors['num_people'] = "Missing input";
                    echo "<script>alert('num miss input')</script>";
                } 
            }
            $c = count($errors);
         
           
            // image 
            if(strlen($_FILES['image']['name'])!=0)
            {
               
                 if ($errorLevel > 0) {
                // Set the error message to the errors array        
                $errors["image"] = $error_messages[$errorLevel];
            } else {
                if (file_exists($temp_file)) {
                    $size = $_FILES["image"]["size"];
                    if ($size <= $max) {
                        $permitted = ["gif", "jpg", "jpeg", "png"];
                        $ext = pathinfo($filename, PATHINFO_EXTENSION);
                        if (in_array($ext, $permitted)) {
                            move_uploaded_file($temp_file, $target_file);
                            //$errors["image"] = "The file $filename has been uploaded.";
                        } else {
                            $errors["image"] = "$filename type is not permitted";
                        }
                    } else {
                        $errors["image"] = "$filename is too big – upload failed";
                    }
                } else {
                    $errors["image"] = "File upload has failed";
                }
            }
            $filename = $_FILES["image"]["name"];
            $temp_file = $_FILES["image"]["tmp_name"];
            $type = $_FILES["image"]["type"];
            $size = $_FILES["image"]["size"];
            $errorLevel = $_FILES["image"]["error"];

            $error_messages = [
                "Upload successful",
                "File exceeds maximum upload size specified by default",
                "File exceeds size specified by MAX_FILE_SIZE",
                "File only partially uploaded",
                "Form submitted with no file specified",
                "",
                "No temporary folder",
                "Cannot write file to disk",
                "File type is not permitted"
            ];

            $destination = 'static/assets/photos/';
            $target_file = $destination . $filename;
            $max = 3000000;
            if ($errorLevel > 0) {
                // Set the error message to the errors array        
                $errors["image"] = $error_messages[$errorLevel];
            } else {
                if (file_exists($temp_file)) {
                    $size = $_FILES["image"]["size"];
                    if ($size <= $max) {
                        $permitted = ["gif", "jpg", "jpeg", "png"];
                        $ext = pathinfo($filename, PATHINFO_EXTENSION);
                        if (in_array($ext, $permitted)) {
                            move_uploaded_file($temp_file, $target_file);
                            //$errors["image"] = "The file $filename has been uploaded.";
                        } else {
                            $errors["image"] = "$filename type is not permitted";
                        }
                    } else {
                        $errors["image"] = "$filename is too big – upload failed";
                    }
                } else {
                    $errors["image"] = "File upload has failed";
                }
            }
        }
        $record = compact("first_name", "last_name", "email","booking_date","booking_time","num_people","filename");

      
         
            if (count($errors) == 0) {
               
                $requestAction->editRecord($record,$booking_id);
            
                $records = $requestAction->viewRecords();
                include 'app/view/viewRecords.php';
            }
            else 
            {
                echo "<script>alert('$c error! please check again')</script>";
            }
        }
        
    }else if($action == 'deleteRecord')
        {
            $booking_id =$_GET['booking_id'];
           
            $requestAction->DeleteRecord($booking_id);
            $records =  $requestAction->ViewRecords();
            echo "<script>alert('delete')</script>";
            include 'app/view/viewRecords.php';

        }
}
else{
    $requestAction->index();
}
include_once 'footer.php';
?>
<a href="?">Home</a>
<a href="?action=getData">get data from server</a>
<a href="?action=getFromDB">get from db</a>