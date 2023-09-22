<?php
    include 'header.php';
?>

<h1>These are your results!</h1>

 <div class = "container-search">

<?php 

if(isset($_POST['submit-search'])){
         $search = mysqli_real_escape_string($conn, $_POST['search']);
    
       
         $sql = "SELECT * FROM article WHERE a_title LIKE '%$search%' OR a_text LIKE '%$search%' OR a_introduction LIKE '%$search%' OR a_date LIKE '%$search%' OR a_author LIKE '%$search%'";

         $result = mysqli_query($conn, $sql);
         $queryResult = mysqli_num_rows($result);

         echo "There are " .$queryResult. " results!";

         if($queryResult > 0) {
         	while ($row = mysqli_fetch_assoc($result)) {
         	    echo "<div class='article-box'>
                 <br>
                        <h3>".$row['a_title']."</h3>
                     <br>
                        <p><em>".$row['a_text']."</em></p>
                        <br>
                        <p><strong>".$row['a_date']."</strong></p>
                        <h4>".$row['a_author']."</h4>
                        <hr>   
                    </div><br><br>";
            }
        }  

        else {
         echo " There are no results matching your search!";
        }

        
 }     

?>

</div>



 