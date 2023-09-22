<?php 
  session_start(); 

  if (!isset($_SESSION['perdoruesi'])) {
  	$_SESSION['msg'] = "You must log in first!";
  	header('location: signin.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['perdoruesi']);
  	header("location: signin.php");
  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
	<link rel="stylesheet" type="text/css" href="styles2.css">
  <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body>

<div class="dritarja1">
  <div class="main">
    <?php if (isset($_SESSION['sukses'])) : ?>
        <div class="error sukses" >
            <h3>
            <?php 
                echo $_SESSION['sukses']; 
                unset($_SESSION['sukses']);
            ?>
            </h3>
        </div>
    <?php endif ?>

    <?php  if (isset($_SESSION['perdoruesi'])) : ?>
      <p style="font-style: italic;font-size: 4rem;color: #000;">Welcome <strong><?php echo $_SESSION['perdoruesi']; ?> !</strong></p>
      <button> <a href="logout.php" style="color: #000;text-shadow: 2px 2px 8px #000;">logout</a></button> 
    <?php endif ?>
  </div>
    <div class="wrapper">
    <div class="wrapper_inner">
      <div class="vertical_wrap">
      <div class="backdrop"></div>
      <div class="vertical_bar">
        <div class="profile_info">
          </div>

        </div>
        <ul class="menu">
          <li>
            <span class="icon"><i class="fas fa-utensils"></i></span>
            <button onclick="show('diet')" class="btn" value="Diet">Diet</button>
          </li>
          <li>
            <span class="icon"><i class="fas fa-dumbbell"></i></span>
          <button  onclick="show('exercise')" class="btn" value="Exercises">Exercises</button>
          </li>
        </ul>

        <ul class="social">
          <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
          <li><a href="#"><i class="fab fa-twitter"></i></a></li>
          <li><a href="#"><i class="fab fa-instagram"></i></a></li>
        </ul>
      </div>
    </div>
    <div class="main_container">
      <div class="top_bar">
        <div class="hamburger">
          <i class="fas fa-bars"></i>
        </div>
        <div class="logo">
          Fit<span>Formula</span>
        </div>
      </div>

        <?php

        $connection=mysqli_connect('localhost','root','','FitFormula');
        
        if(!$connection){
          echo "Could not connect to database! " . mysqli_connect_error();
          die();
        }
        
        $userid=11;
        
        $query="SELECT * FROM User WHERE ID='$userid'";
        
        if($result=mysqli_query($connection,$query)){
          $row=mysqli_fetch_assoc($result);
        }
        
        $cals=10*$row['Weight']+6.25*$row['Height']-5*$row['Age'];
        
        if($row['Sex']=='M'){
          $cals=$cals+5;
        }
        else{
          $cals=$cals-161;
        }
        
        if($row['IdealWeight']>$row['Weight']){
          $cals=$cals*1.2;
        }
        else if($row['IdealWeight']<$row['Weight']){
          $cals=$cals*0.9;
        }
        
        if($row['BodyType']==1){
          $cals=$cals*1.2;
        }
        else if($row['BodyType']==3){
          $cals=$cals*0.9;
        }
        
        
        
        $diet=$row['DietType'];
        
        
        $breakfastquery="SELECT * FROM Food WHERE Meal=1";
        
        $breakfastcount=0;
        if($breakfastresult=mysqli_query($connection,$breakfastquery)){
          while($breakfastrow[]=mysqli_fetch_assoc($breakfastresult)){
            $breakfastcount++;
          }
        }
        
        
        
        $smoothiequery="SELECT * FROM Food WHERE Meal=5";
        
        $smoothiecount=0;
        if($smoothieresult=mysqli_query($connection,$smoothiequery)){
          while($smoothierow[]=mysqli_fetch_assoc($smoothieresult)){
            $smoothiecount++;
          }
        }
        
        
        
        $lunchquery="SELECT * FROM Food WHERE DietType='$diet' AND Meal=2";
        
        $lunchcount=0;
        if($lunchresult=mysqli_query($connection,$lunchquery)){
          while($lunchrow[]=mysqli_fetch_assoc($lunchresult)){
            $lunchcount++;
          }
        }
        
        
        
        $snackquery="SELECT * FROM Food WHERE Meal=3";
        
        $snackcount=0;
        if($snackresult=mysqli_query($connection,$snackquery)){
          while($snackrow[]=mysqli_fetch_assoc($snackresult)){
            $snackcount++;
          }
        }
        
        
        
        $dinnerquery="SELECT * FROM Food WHERE DietType='$diet' AND Meal=4";
        
        $dinnercount=0;
        if($dinnerresult=mysqli_query($connection,$dinnerquery)){
          while($dinnerrow[]=mysqli_fetch_assoc($dinnerresult)){
            $dinnercount++;
          }
        }
        
        
        
        $array=array();
        $caloriesBool=FALSE;
        while($caloriesBool==FALSE){
        
          $array=calorieCount($array,$breakfastcount,$breakfastrow,$smoothiecount,$smoothierow,$lunchcount,$lunchrow,$snackcount,$snackrow,$dinnercount,$dinnerrow);
        
          $calorieSum=sumCalories($array);
          if($cals>$calorieSum){
            if($cals-$calorieSum<150){
              $caloriesBool=TRUE;
            }
          }
          else{
            if($calorieSum-$cals<150){
              $caloriesBool=TRUE;
            }
          }
        
        }
        
        function calorieCount($array,$breakfastcount,$breakfastrow,$smoothiecount,$smoothierow,$lunchcount,$lunchrow,$snackcount,$snackrow,$dinnercount,$dinnerrow){
        
          $breakfastrand=rand(0,$breakfastcount-1);
          $breakfastcalorie=$breakfastrow[$breakfastrand]['Calories'];
          $array[0]=$breakfastrand;
          $array[1]=$breakfastcalorie;
        
        
          $smoothierand=rand(0,$smoothiecount-1);
          $smoothiecalorie=$smoothierow[$smoothierand]['Calories'];
          $array[2]=$smoothierand;
          $array[3]=$smoothiecalorie;
        
        
          $lunchrand=rand(0,$lunchcount-1);
          $lunchcalorie=$lunchrow[$lunchrand]['Calories'];
          $array[4]=$lunchrand;
          $array[5]=$lunchcalorie;
        
        
          $snackrand=rand(0,$snackcount-1);
          $snackcalorie=$snackrow[$snackrand]['Calories'];
          $array[6]=$snackrand;
          $array[7]=$snackcalorie;
        
        
          $dinnerrand=rand(0,$dinnercount-1);
          $dinnercalorie=$dinnerrow[$dinnerrand]['Calories'];
          $array[8]=$dinnerrand;
          $array[9]=$dinnercalorie;
        
          return $array;
        
        }
        
        function sumCalories($array){
          $sum=0;
          for($i=1;$i<10;$i=$i+2){
            $sum=$sum+$array[$i];
          }
        
          return $sum;
        }
        
        ?>
        
        
            <div id="diet" class="container">
        
              <h1> Daily Meal Plan - <?php echo sumCalories($array)." Calories"?></h1>
        
              <div class="containers">
                <div class="mealheader">
                   <div class="meal"> Breakfast </div>
                   <div class="dishname"> <?php echo " -".$breakfastrow[$array[0]]['Name']?> </div>
                </div>
                <div class="mealbody">
                  <div class="mealpic"> <?php echo '<img height=30px width=30px src="data:image/jpeg;base64,'.base64_encode($breakfastrow[$array[0]]['Picture']).'"/>';?> </div>
                  <div class="mealdesc">
                    <div class="mealcal"> <?php echo "Calories: ".$array[1]?>  <?php echo "Prep Time: ".$breakfastrow[$array[0]]['PrepTime']?> </div>
                    <div class="mealing"> <?php echo "Ingrudients: ".$breakfastrow[$array[0]]['Ingridients']?> </div>
                  </div>
                </div>
              </div>
        
              <div class="containers">
                <div class="mealheader">
                   <div class="meal"> Smoothie </div>
                   <div class="dishname"> <?php echo " -".$smoothierow[$array[2]]['Name']?> </div>
                </div>
                <div class="mealbody">
                  <div class="mealpic"> <?php echo '<img height=30px width=30px src="data:image/jpeg;base64,'.base64_encode($smoothierow[$array[2]]['Picture']).'"/>';?> </div>
                  <div class="mealdesc">
                    <div class="mealcal"> <?php echo "Calories: ".$array[3]?>  <?php echo "Prep Time: ".$smoothierow[$array[2]]['PrepTime']?> </div>
                    <div class="mealing"> <?php echo "Ingrudients: ".$smoothierow[$array[2]]['Ingridients']?> </div>
                  </div>
                </div>
              </div>
        
              <div class="containers">
                <div class="mealheader">
                   <div class="meal"> Lunch </div>
                   <div class="dishname"> <?php echo " -".$lunchrow[$array[4]]['Name']?> </div>
                </div>
                <div class="mealbody">
                  <div class="mealpic"> <?php echo '<img height=30px width=30px src="data:image/jpeg;base64,'.base64_encode($lunchrow[$array[4]]['Picture']).'"/>';?> </div>
                  <div class="mealdesc">
                    <div class="mealcal"> <?php echo "Calories: ".$array[5]?>  <?php echo "Prep Time: ".$lunchrow[$array[4]]['PrepTime']?> </div>
                    <div class="mealing"> <?php echo "Ingrudients: ".$lunchrow[$array[4]]['Ingridients']?> </div>
                  </div>
                </div>
              </div>
        
              <div class="containers">
                <div class="mealheader">
                   <div class="meal"> Snack </div>
                   <div class="dishname"> <?php echo " -".$snackrow[$array[6]]['Name']?> </div>
                </div>
                <div class="mealbody">
                  <div class="mealpic"> <?php echo '<img height=30px width=30px src="data:image/jpeg;base64,'.base64_encode($snackrow[$array[6]]['Picture']).'"/>';?> </div>
                  <div class="mealdesc">
                    <div class="mealcal"> <?php echo "Calories: ".$array[7]?>  <?php echo "Prep Time: ".$snackrow[$array[6]]['PrepTime']?> </div>
                    <div class="mealing"> <?php echo "Ingrudients: ".$snackrow[$array[6]]['Ingridients']?> </div>
                  </div>
                </div>
              </div>
        
              <div class="containers">
                <div class="mealheader">
                   <div class="meal"> Dinner </div>
                   <div class="dishname"> <?php echo " -".$dinnerrow[$array[8]]['Name']?> </div>
                </div>
                <div class="mealbody">
                  <div class="mealpic"> <?php echo '<img height=30px width=30px src="data:image/jpeg;base64,'.base64_encode($dinnerrow[$array[8]]['Picture']).'"/>';?> </div>
                  <div class="mealdesc">
                    <div class="mealcal"> <?php echo "Calories: ".$array[9]?>  <?php echo "Prep Time: ".$dinnerrow[$array[8]]['PrepTime']?> </div>
                    <div class="mealing"> <?php echo "Ingrudients: ".$dinnerrow[$array[8]]['Ingridients']?> </div>
                  </div>
                </div>
              </div>
        
            </div>

      <?php
        
        $body=$row['BodyType'];

        $shoulderquery="SELECT * FROM Exercises WHERE BodyType='$body' AND BodyPart=1";

        $shouldercount=0;
     
        if($shoulderresult=mysqli_query($connection,$shoulderquery)){
            while($shoulderrow[]=mysqli_fetch_assoc($shoulderresult)){
                $shouldercount++;
            }
        }

        $armquery="SELECT * FROM Exercises WHERE BodyType='$body' AND BodyPart=2";

        $armcount=0;
     
        if($armresult=mysqli_query($connection,$armquery)){
            while($armrow[]=mysqli_fetch_assoc($armresult)){
                $armcount++;
            }
        }

        $chestquery="SELECT * FROM Exercises WHERE BodyType='$body' AND BodyPart=3";

        $chestcount=0;
     
        if($chestresult=mysqli_query($connection,$chestquery)){
            while($chestrow[]=mysqli_fetch_assoc($chestresult)){
                $chestcount++;
            }
        }

        $absquery="SELECT * FROM Exercises WHERE BodyType='$body' AND BodyPart=4";

        $abscount=0;
     
        if($absresult=mysqli_query($connection,$absquery)){
            while($absrow[]=mysqli_fetch_assoc($absresult)){
                $abscount++;
            }
        }

        $backquery="SELECT * FROM Exercises WHERE BodyType='$body' AND BodyPart=5";

        $backcount=0;
     
        if($backresult=mysqli_query($connection,$backquery)){
            while($backrow[]=mysqli_fetch_assoc($backresult)){
                $backcount++;
            }
        }

        $thighsqeury="SELECT * FROM Exercises WHERE BodyType='$body' AND BodyPart=6";

        $thighscount=0;
     
        if($thighsresult=mysqli_query($connection,$thighsqeury)){
            while($thighsrow[]=mysqli_fetch_assoc($thighsresult)){
                $thighscount++;
            }
        }
        
        if($body==1){
            $tm=25;
        }
        else if($body==2){
            $tm=35;
        }
        else{
            $tm=45;
        }


        $array=array();
        $exBool=FALSE;
        while($exBool==FALSE){

            $array=timeCount($array,$shouldercount,$shoulderrow,$armcount,$armrow,$chestrow,$chestcount,$absrow,$abscount,$backrow,$backcount,$thighscount,$thighsrow);
            $timeSum=sumTime($array);
            if($timeSum-$tm<5){
                $exBool=true;
            }
            else if($tm-$timeSum<5){
                $exBool=true;
            }

        }

    function timeCount($array,$shouldercount,$shoulderrow,$armcount,$armrow,$chestrow,$chestcount,$absrow,$abscount,$backrow,$backcount,$thighscount,$thighsrow){

        $shoulderrand=rand(0,$shouldercount-1);
        $shouldertime=$shoulderrow[$shoulderrand]['Time'];
        $array[0]=$shoulderrand;
        $array[1]=$shouldertime;


        $armsrand=rand(0,$armcount-1);
        $armstime=$armrow[$armsrand]['Time'];
        $array[2]=$armsrand;
        $array[3]=$armstime;


        $chestrand=rand(0,$chestcount-1);
        $chesttime=$chestrow[$chestrand]['Time'];
        $array[4]=$chestrand;
        $array[5]=$chesttime;


        $absrand=rand(0,$abscount-1);
        $abstime=$absrow[$absrand]['Time'];
        $array[6]=$absrand;
        $array[7]=$abstime;


        $backrand=rand(0,$backcount-1);
        $backtime=$backrow[$backrand]['Time'];
        $array[8]=$backrand;
        $array[9]=$backtime;


        $thighsrand=rand(0,$thighscount-1);
        $thighstime=$thighsrow[$thighsrand]['Time'];
        $array[10]=$thighsrand;
        $array[11]=$thighstime;


        return $array;

    }

    function sumtime($array){
        $sum=0;
        for($i=1;$i<12;$i=$i+2){
            $sum=$sum+$array[$i];
        }

        return $sum;
    }
        ?>
      <div id="exercise" class="container">
            <h1> Daily Exercise Plan - <?php echo sumtime($array)." minutes"?> </h1>

            <div class="containers">
                <div class="mealheader">
                   <div class="meal"> Shoulders </div>
                   <div class="dishname"> <?php echo " - ".$shoulderrow[$array[0]]['Emri'] . " (". $array[1]." minutes)"?> </div>
                </div>
                <div class="mealbody">
                    <div class="mealpic"> <?php echo '<img height=30px width=30px src="data:image/jpeg;base64,'.base64_encode($shoulderrow[$array[0]]['Foto']).'"/>';?> </div>
                    <div class="mealcal"> <?php echo "Description: ".$shoulderrow[$array[0]]['Pershkrimi']?> </div>
                </div>
            </div>

            <div class="containers">
                <div class="mealheader">
                   <div class="meal"> Arms </div>
                   <div class="dishname"> <?php echo " - ".$armrow[$array[2]]['Emri'] . " (". $array[3]." minutes)"?> </div>
                </div>
                <div class="mealbody">
                    <div class="mealpic"> <?php echo '<img height=30px width=30px src="data:image/jpeg;base64,'.base64_encode($armrow[$array[2]]['Foto']).'"/>';?> </div>
                    <div class="mealcal"> <?php echo "Description: ".$armrow[$array[2]]['Pershkrimi']?> </div>
                </div>
            </div>

            <div class="containers">
                <div class="mealheader">
                   <div class="meal"> Chest </div>
                   <div class="dishname"> <?php echo " - ".$chestrow[$array[4]]['Emri'] . " (". $array[5]." minutes)"?> </div>
                </div>
                <div class="mealbody">
                    <div class="mealpic"> <?php echo '<img height=30px width=30px src="data:image/jpeg;base64,'.base64_encode($chestrow[$array[4]]['Foto']).'"/>';?> </div>
                    <div class="mealcal"> <?php echo "Description: ".$chestrow[$array[4]]['Pershkrimi']?> </div>
                </div>
            </div>

            <div class="containers">
                <div class="mealheader">
                   <div class="meal"> ABS </div>
                   <div class="dishname"> <?php echo " - ".$absrow[$array[6]]['Emri'] . " (". $array[7]." minutes)"?> </div>
                </div>
                <div class="mealbody">
                    <div class="mealpic"> <?php echo '<img height=30px width=30px src="data:image/jpeg;base64,'.base64_encode($absrow[$array[6]]['Foto']).'"/>';?> </div>
                    <div class="mealcal"> <?php echo "Description: ".$absrow[$array[6]]['Pershkrimi']?> </div>
                </div>
            </div>

            <div class="containers">
                <div class="mealheader">
                   <div class="meal"> Back </div>
                   <div class="dishname"> <?php echo " - ".$backrow[$array[8]]['Emri'] . " (". $array[9]." minutes)"?> </div>
                </div>
                <div class="mealbody">
                    <div class="mealpic"> <?php echo '<img height=30px width=30px src="data:image/jpeg;base64,'.base64_encode($backrow[$array[8]]['Foto']).'"/>';?> </div>
                    <div class="mealcal"> <?php echo "Description: ".$backrow[$array[8]]['Pershkrimi']?> </div>
                </div>
            </div>

            <div class="containers">
                <div class="mealheader">
                   <div class="meal"> Thighs </div>
                   <div class="dishname"> <?php echo " - ".$thighsrow[$array[10]]['Emri'] . " (". $array[11]." minutes)"?> </div>
                </div>
                <div class="mealbody">
                    <div class="mealpic"> <?php echo '<img height=30px width=30px src="data:image/jpeg;base64,'.base64_encode($thighsrow[$array[10]]['Foto']).'"/>';?> </div>
                    <div class="mealcal"> <?php echo "Description: ".$thighsrow[$array[10]]['Pershkrimi']?> </div>
                </div>
            </div>

        </div>
      </div>
    </div>
    </div>
  </div>

<script>
  var container=Array.from(document.querySelectorAll("div.container"));
  for(i=0;i<container.length;i++){
    container[i].style.display='none';
  }

  function show(step){

    for(i=0;i<container.length;i++){
    container[i].style.display='none';
    }
    
    document.getElementById(step).style.display='block';
  }

  var hamburger = document.querySelector(".hamburger");
  var wrapper  = document.querySelector(".wrapper");
  var backdrop = document.querySelector(".backdrop");

  hamburger.addEventListener("click", function(){
    wrapper.classList.add("active");
  })

  backdrop.addEventListener("click", function(){
    wrapper.classList.remove("active");
  })
</script>
</body>
</html>