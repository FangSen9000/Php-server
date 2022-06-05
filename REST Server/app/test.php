<?php
  
   $list = ['first_name' => 'SD', 'last_name' => 'ishf', 'email' => '2his@od.com', 'booking_date' => '2022-04-28', 'booking_time' => '17:20', 'num_people' => '12', 'filename' => '无标题.png'];
   $t1 = json_encode($list);
   $t2 = json_decode($t1);
   echo "$t1";
   echo "$t2";
   $err="";
   $s = array_diff_key($a,$list);

  echo "$s";