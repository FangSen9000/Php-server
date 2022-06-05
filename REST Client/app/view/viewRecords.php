<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-3 text-center"></div>
        <div class="col-md-6 box text-center">View Records:<?= count($records) ?>results</div>
        <div class="col-md-3 text-center"></div>
    </div>
    <div class="row">
        <div class="col-md-2 text-center"></div>
        <div class="col-md-12 jumbotron text-center">
            <table class="table table-striped table-hover" >
                <tr class="info">
                    <th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Booking Date</th><th>Booking Time</th><th>Number of People</th>
                   
                    
                    <th> Filename</th><th>Option</th>
                </tr>
                <?php foreach ($records as $row): ?>
                    <tr>
                        <td align="left"><?= $row['booking_id'] ?></td> 
                        <td align="left"><?= $row['first_name'] ?></td>
                        <td align="left"><?= $row['last_name'] ?></td> 
                        <td align="left"><?= $row['email'] ?></td> 
                        <td align="left"><?= $row['booking_date'] ?></td> 
                        <td align="left"><?= $row['booking_time'] ?></td> 
                        <td align="left"><?= $row['num_people'] ?></td>
                     
                        <td align="left">
                              
                            <img src="static/assets/photos/<?= $row['filename']?>" width="40%">
                        </td>
                     
                       
                        <td align="left">
                            <a href="?action=editRecords&booking_id=<?= $row['booking_id'] ?>&first_name=<?= $row['first_name'] ?>&last_name=<?= $row['last_name'] ?>&email=<?= $row['email'] ?>&booking_date=<?= $row['booking_date'] ?>&booking_time=<?= $row['booking_time']?>&num_people=<?= $row['num_people'] ?>&filename=<?= $row['filename'] ?>">Edit</a> 
                            &nbsp;
                            <a href="?action=deleteRecord&booking_id=<?= $row['booking_id'] ?>" >Delete</a> 
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="col-md-3 text-center"></div>
    </div>
</div>
