<?php

include_once 'app/view/header.php';
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if($action == 'home')
    {
        include_once('app/view/content.php');
    }
    else if ($action == 'viewRecords') {
        //read records code here
       
        //display records in bootstrap table
        include_once("app/view/viewRecords.php");
    } else if ($action == 'editContacts') {
        include_once("app/view/editRecords.php");
        $id = $_GET['id'];
        $firstname = $_GET['firstname'];
        $lastname = $_GET['lastname'];
        $Email = $_GET['email'];
        $Mobile = $_GET['mobile'];
        $photoname = $_GET['photoname'];

        $first_name = '';
        $last_name = '';
        $email = '';
        $mobile = '';
        $filename = '';
        $errors = [];
        if (isset($_POST['submit'])) {
            //validation
            if (isset($_POST['first_name'])) {//设定first_name的输入规范
                $first_name = $_POST['first_name'];
                if (strlen($first_name) == 0) {
                    $errors['first_name'] = 'First Name is missing input';
                } elseif (!ctype_alpha($first_name)) {
                    $errors['first_name'] = 'Enter a valid First Name';
                }
            }

            if (isset($_POST['last_name'])) {//设定last_name的输入规范
                $last_name = $_POST['last_name'];
                if (strlen($last_name) == 0) {
                    $errors['last_name'] = 'Last Name is missing input';
                } elseif (!ctype_alpha($last_name)) {
                    $errors['last_name'] = 'Enter a valid Last Name';
                }
            }

            if (isset($_POST['email'])) {//设定email的输入规范
                $email = trim($_POST['email']);
                if (strlen($email) == 0) {
                    $errors['email'] = "Email address is missing input";
                } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = "Enter a valid Email Address";
                }
            }

            if (isset($_POST['mobile'])) {
                $mobile = trim($_POST['mobile']);
                if (strlen($mobile) == 0) {
                    $errors['mobile'] = "Missing input";
                } elseif (strlen($mobile) < 10) {
                    $errors['mobile'] = "Mobile number must be 10 digits";
                } else if (!ctype_digit($mobile)) {
                    $errors['mobile'] = "Enter a valid mobile number";
                }
            }
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

            $destination = 'D:/xampp/htdocs/A1P4/img/';
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

            if (count($errors) == 0) {
                $values = [$first_name, $last_name, $email, $mobile, $filename];
                $dsn = 'mysql:host=localhost;dbname=contactsdb';
                $username = 'root';
                $password = '';
                $conn = new PDO($dsn, $username, $password);
                $sql = "update contacts set first_name=? ,last_name=?,email=?,mobile=?,photo_filename=? where id = $id";
                $statement = $conn->prepare($sql);
                $success = $statement->execute($values);
                if ($success) {
                    include_once 'index.php'; //如果无错误就返回主页
                    echo"Edit contact record successed!";
                } else {
                    include_once 'index.php';
                    echo"Insert contact record failed!";
                }
            } else {
                include_once 'includes/editContacts.php'; //有不符合规范的就返回form并提示
            }
        } else {
            include_once 'includes/editContacts.php';
        }
    } else if ($action == 'deleteContacts') {
        $id = $_GET['id'];
        $dsn = 'mysql:host=localhost;dbname=contactsdb';
        $username = 'root';
        $password = '';
        $conn = new PDO($dsn, $username, $password);
        $sql = "delete from contacts where id = $id";
        $statement = $conn->query($sql);
        $success = $statement->execute();
        if ($success) {
            include_once 'index.php';
            echo "Delete booking record successed!";
        } else {
            include_once 'index.php';
            echo "Delete booking record failed!";
        }
    } else if ($action == 'addRecords') {

        $first_name = '';
        $last_name = '';
        $email = '';
        $mobile = '';
        $filename = '';
        $errors = [];
        include_once("app/view/addRecords.php");
        if (isset($_POST['submit'])) {
            //validation
            if (isset($_POST['first_name'])) {//设定first_name的输入规范
                $first_name = $_POST['first_name'];
                if (strlen($first_name) == 0) {
                    $errors['first_name'] = 'First Name is missing input';
                } elseif (!ctype_alpha($first_name)) {
                    $errors['first_name'] = 'Enter a valid First Name';
                }
            }

            if (isset($_POST['last_name'])) {//设定last_name的输入规范
                $last_name = $_POST['last_name'];
                if (strlen($last_name) == 0) {
                    $errors['last_name'] = 'Last Name is missing input';
                } elseif (!ctype_alpha($last_name)) {
                    $errors['last_name'] = 'Enter a valid Last Name';
                }
            }

            if (isset($_POST['email'])) {//设定email的输入规范
                $email = trim($_POST['email']);
                if (strlen($email) == 0) {
                    $errors['email'] = "Email address is missing input";
                } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = "Enter a valid Email Address";
                }
            }

            if (isset($_POST['mobile'])) {
                $mobile = trim($_POST['mobile']);
                if (strlen($mobile) == 0) {
                    $errors['mobile'] = "Missing input";
                } elseif (strlen($mobile) < 10) {
                    $errors['mobile'] = "Mobile number must be 10 digits";
                } else if (!ctype_digit($mobile)) {
                    $errors['mobile'] = "Enter a valid mobile number";
                }
            }
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

            $destination = 'D:/xampp/htdocs/A1P4/img/';
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

            if (count($errors) == 0) {
                $values = [$first_name, $last_name, $email, $mobile, $filename];
                $dsn = 'mysql:host=localhost;dbname=contactsdb';
                $username = 'root';
                $password = '';
                $conn = new PDO($dsn, $username, $password);
                $sql = "insert into contacts (first_name,last_name,email,mobile,photo_filename)values(?,?,?,?,?)";
                $statement = $conn->prepare($sql);
                $success = $statement->execute($values);
                if ($success) {
                    include_once 'index.php'; //如果无错误就返回主页
                    echo"Insert contact record successed!";
                } else {
                    include_once 'index.php';
                    echo"Insert contact record failed!";
                }
            } else {
                include_once 'includes/addContacts.php'; //有不符合规范的就返回form并提示
            }
        } else {
            include_once 'includes/addContacts.php';
        }
    } else if ($action == 'seachercontacts') {
        $keyword = '';
        $errors = [];
        if (isset($_POST['send'])) {
            //validation
            if (isset($_POST['keyword'])) {//设定keyword的输入规范
                $keyword = $_POST['keyword'];
                if (strlen($keyword) == 0) {
                    $errors['keyword'] = 'keyword is missing input';
                }

                if (count($errors) == 0) {
                    $conn = mysqli_connect('localhost', 'root', '', 'contactsdb');
                    $res = mysqli_query($conn, "select * from contacts where first_name like '%$keyword%' or last_name like '%$keyword%' or email like '%$keyword%' or mobile like '%$keyword%' or photo_filename like '%$keyword%'") or die(mysqli_error($conn));
                    $records = [];
                    while ($row = mysqli_fetch_assoc($res)) {
                        $records[] = $row;
                    }
                    include_once("includes/viewContacts.php");
                }
            } else {
                include_once 'includes/seacherContacts.php'; //有不符合规范的就返回form并提示
            }
        } else {
            include_once 'includes/seacherContacts.php';
        }
    }
} else {
    include_once('app/view/content.php');
}
include_once('app/view/footer.php');





