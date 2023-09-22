<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="diet.css?v=<?php echo time(); ?>">
    </head>
    <body>

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


        <div class="split left">

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
    </body>
        </html>