<?php
    include 'header.php';
?>

<br><br>
<form action = "search.php" method="POST">
        <input type = "text" name= "search" placeholder="Type something..." class="txt">
        <button type = "submit" name = "submit-search" class="btn btn-warning">Search</button>
</form>


    <div class = "container">
        
        <div class="rreshta">

            <?php
            

            $sql = "SELECT * FROM article";
            $result = mysqli_query($conn, $sql);
            $queryResults = mysqli_num_rows($result)>0;

            if($queryResults){
                while ($row = mysqli_fetch_assoc($result)){

            
            ?>
            <div class="kolona">
                <div class="permbajtja">
                    <div class="imazhe"><?php echo '<img src="data:image; base64,' .base64_encode($row['a_image']).'" alt = "Image" style="width: 400px;  height:180px" >'; ?>
                        <span><h4> <?php echo $row['a_date']; ?></h4></span>
                    </div>

                    <div class= "pershkrime">
                        <h3><?php echo  $row['a_title']; ?></h3>
                        <p><?php echo $row['a_introduction']; ?></p>
                        <h5><?php echo $row['a_author']; ?></h5>
                        <br>
                        <a href="details.php?id=<?php echo $row['a_id']; ?>"class = "buton" >Read</a>
                    </div>
                </div>
            </div>  
    
                    <?php

                    
                }

            }

            else{

                    echo "no information!";
                }

            ?>

            
           </div>
    </div>
    
</body>
</html>
        
