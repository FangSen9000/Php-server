<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Contacts App</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="static\assets\css\bootstrap.min.css">
        <script src="static\assets\js\jquery.min.js"></script>
        <script src="static\assets\js\popper.min.js"></script>
        <script src="static\assets\js\bootstrap.min.js"></script>
        <link rel="stylesheet" href="static/assets/css/styles.css">
      
    </head>
    
    <body>

        <nav class="navbar navbar-expand-md bg-custom navbar-dark fixed-top">
            <a class="navbar-brand" href="index.php">Contacts App</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?action=addRecords">Add records</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?action=viewRecords">View All records</a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" href="?action=searchRecords">Search records</a>
                    </li>
                    <!-- Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="navbardrop" data-toggle="dropdown">
                            Contacts
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="?action=editRecords">Edit Records</a>
                            <a class="dropdown-item" href="">Link 2</a>
                            <a class="dropdown-item" href="">Link 3</a>
                        </div>
                    </li>
                </ul>
            </div>  
        </nav>
        <br>