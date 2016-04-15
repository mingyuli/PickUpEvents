<?php
 $h = 'pearl.ils.unc.edu';
 $u = 'mingyuli';
 $p = '5920';
 $dbname = 'mingyuli_db';
 $db = mysqli_connect($h,$u,$p,$dbname);
 if (mysqli_connect_errno()) {
 echo "Problem connecting: " . mysqli_connect_error();
 exit();
 }
 ?>