<?php

 $id= $_GET['id'];

 $posible = "datax/{$id}";

 if(is_file($posible)){
  
   unlink($posible);
 }

 header("Location:./");
