<?php

class PDOFactory {
    const DB_CONFIG_FILE_PATH = __DIR__.'\dbconfig.json';
    
    var $pdo;
    function __construct()
    {
       
        $f = fopen(PDOFactory::DB_CONFIG_FILE_PATH,"r");
        $content = fread($f, filesize(PDOFactory::DB_CONFIG_FILE_PATH));
        $json_data = json_decode($content);
        
        $dsn = $json_data->DSN;
        $username = $json_data->USERNAME;
        $password = $json_data->PASSWORD;
        
        $this->pdo = new PDO($dsn,$username,$password);
       
       

    }
    function viewRecords()
    {
        $records = [];
        $sql = 'select * from bookings';
        $statement = $this->pdo->query($sql);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $records = $statement->fetchAll();
        return $records;
    }
    function searchRecords($keyword)
    {
        $sql =  "select * from bookings where first_name like '%$keyword%' 
        or last_name like '%$keyword%' or email like '%$keyword%' or
         booking_date like '%$keyword%' or booking_time like '%$keyword%' or 
         num_people like '%$keyword%' or
        filename like '%$keyword%'";
        $statement = $this->pdo->query($sql);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $records = $statement->fetchAll();
        return $records;
 
    }
    function addRecord($record)
    {
        $sql = 'insert into bookings
                (first_name, last_name, email, booking_date,booking_time,
                num_people, filename)
                values (:firstname,:lastname,:email,:bookingdate,:bookingtime,
                :numpeople,:filename)';
                $statement = $this->pdo->prepare($sql);
                $statement->bindParam(":firstname",$record['first_name']);
                $statement->bindParam(":lastname",$record['last_name']);
                $statement->bindParam(":email",$record['email']);
                $statement->bindParam(":bookingdate",$record['booking_date']);
                $statement->bindParam(":bookingtime",$record['booking_time']);
                $statement->bindParam(":numpeople",$record['num_people']);
                $statement->bindParam(":filename",$record['filename']);
                $success = $statement->execute();
        return $success;
    }
    function editRecord($record,$id)
    {
        // $record = ['ss','ss', 'dd','1970-01-01','12:12','23','111.jpg'];
        $sql = "update bookings set first_name=:first_name ,last_name=:last_name,email=:email,
        booking_date=:booking_date,booking_time=:booking_time, 
        num_people=:num_people,filename=:filename where booking_id = $id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(":first_name",$record['first_name']);
        $statement->bindParam(":last_name",$record['last_name']);
        $statement->bindParam(":email",$record['email']);
        $statement->bindParam(":booking_date",$record['booking_date']);
        $statement->bindParam(":booking_time",$record['booking_time']);
        $statement->bindParam(":num_people",$record['num_people']);
        $statement->bindParam(":filename",$record['filename']);
        
        $statement->execute();
       
        
    }
    function deleteRecord($id)
    {
        $sql = "delete from bookings where booking_id = $id";
        $statement = $this->pdo->query($sql);
        $success = $statement->execute();
       
    }
   
}
