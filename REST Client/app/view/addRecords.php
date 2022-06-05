<br>
<br>
<div class="container" >

    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 box text-center">
           <h2> Add Contacts</h2>
        </div>
        <div class="col-sm-3"></div>
    </div>

    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 jumbotron">
            <form action="" method="post" novalidate="true" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label">
                        First Name
                        <span class="error" style="color:red">
                            <?= isset($errors['first_name']) ? $errors['first_name'] : "" ?>
                        </span>
                    </label>
                    <input class="form-control" type="text" name="first_name"maxlength="30"  />
                </div>                <div class="form-group">
                    <label class="control-label">
                        Last Name
                    </label>
                    <span class="error" style="color:red">
                        <?= isset($errors['last_name']) ? $errors['last_name'] : "" ?>
                    </span>
                    <input class="form-control" type="text" name="last_name"maxlength="30"  />
                </div>    

                <div class="form-group">
                    <label class="control-label">
                        Email
                    </label>
                    <span class="error" style="color:red">
                        <?= isset($errors['email']) ? $errors['email'] : "" ?>
                    </span>
                    <input class="form-control" type="email" name="email" />
                </div>  

                <div class="form-group">
                    <label>
                        Booking Date:
                        <span class="error" style="color:red">
                            <?= isset($errors['booking_date']) ? $errors['booking_data'] : "" ?>
                        </span>
                    </label>
                    <input class="form-control" type="date" name="booking_date" maxlength="10" />
                </div>
                <div class="form-group">
                    <label>
                        Booking Time:
                        <span class="error" style="color:red">
                            <?= isset($errors['booking_time']) ? $errors['booking_time'] : "" ?>
                        </span>
                    </label>
                    <input class="form-control" type="time" name="booking_time" maxlength="10" />
                </div>
                <div class="form-group">
                    <label>
                        Number of People:
                        <span class="error" style="color:red">
                            <?= isset($errors['num_people']) ? $errors['num_people'] : "" ?>
                        </span>
                    </label>
                    <input class="form-control" type="text" name="num_people" maxlength="10" />
                </div>
          
                <div class="form-group">
                    <label>
                        Room Photo:
                        <span class="error" style="color:red">
                            <?= isset($errors['image']) ? $errors['image'] : "" ?>
                        </span>
                    </label>
                    <input class="form-control" type="file" name="image" />
                </div>


                <input class="btn btn-primary btn-block" type="submit" name="add" value="ADD" />
        </div>  
        </form>
    </div>
    <div class="col-sm-3"></div>
</div>
