<?php

include ("dbh.php");
 

if(isset($_GET['id'])){

    $id = mysqli_real_escape_string($conn,$_GET['id']);
    $sql = "SELECT * FROM article WHERE a_id = $id";

    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);
   
  }
?>


<!DOCTYPE html>
<html>


<?php include 'header.php';?> 
 
<div class ="container">


    <?php if($row): ?>
    
    <div class = "banner-area">
            <center><h2><?php echo $row['a_title'] ?></h2>
            <p><?php echo $row['a_author'] ?></p>
            <p><?php echo $row['a_date'] ?></p></center>
    </div>
<br>
         <div class = "content-area">


                <p><?php echo $row['a_introduction'] ?></p>
                <div class = "image-details"><?php echo '<img src="data:image; base64,' .base64_encode($row['a_image']).'" alt = "Image" style="width: 400px;  height:180px">';?></div>
                <p><?php echo  $row['a_text'] ?></p>
        </div>

    
    <?php else: ?>
        <h5>Nuk ekziston!</h5>

    <?php endif; ?>
</div>

</html>