<?php

$connection=mysqli_connect('localhost','root','','FitFormula');

if(!$connection){
    echo "Couldn't connect to $connection " . mysqli_connect_error();
}

$height=$_POST['height'];
$weight=$_POST['weight'];
$age=$_POST['age'];
$caloriesintake=$_POST['caloriesintake'];

if(isset($_POST['anything'])){
    $diet=1;
}
else if(isset($_POST['keto'])){
    $diet=2;
}
else if(isset($_POST['vag'])){
    $diet=3;
}
else if(isset($_POST['veg'])){
    $diet=4;
}
else if(isset($_POST['paleo'])){
    $diet=5;
}
else{
    $diet=6;
}

if(isset($_POST['ectomorph'])){
    $body=1;
}
else if(isset($_POST['mesomorph'])){
    $body=2;
}
else{
    $body=3;
}

$idealweight=$_POST['idealweight'];
$sex=$_POST['sex'];

$query="INSERT INTO User(Height,Weight,Age,CaloriesIntake,BodyType,DietType,IdealWeight,Sex) 
        VALUES('$height',$weight,'$age','$caloriesintake','$body','$diet','$idealweight','$sex')";

if(!mysqli_query($connection,$query)){
    echo "Not successful $query " . mysqli_error($connection);
}
header('Location: ../homepage/index.php')
?>
