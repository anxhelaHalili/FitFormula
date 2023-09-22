<?php

include 'server.php';


error_reporting(0);

session_start();

if (isset($_SESSION['perdoruesi'])) {
    header("Location: signin.php");
}

if (isset($_POST['butoni2'])) {
    $emriPlote = $_POST['emri'];
    $emerPerdoruesi = $_POST['perdoruesi'];
    $email = $_POST['email'];
    $fjalekalim_1 = mysqli_real_escape_string($conn, $_POST['pw1']);
    $fjalekalim_2 = mysqli_real_escape_string($conn, $_POST['pw2']);


  
  $numer = preg_match('@[0-9]@', $fjalekalim_1);
  $shkronjEmadhe= preg_match('@[A-Z]@', $fjalekalim_1);
  $shkronjEvogel= preg_match('@[a-z]@', $fjalekalim_1);
  $karaktereSpeciale = preg_match('@[^\w]@', $fjalekalim_1);
 


    if ($fjalekalim_1 == $fjalekalim_2) {
        if(strlen($fjalekalim_1) >= 8 && $numer && $shkronjEmadhe && $shkronjEvogel && $karaktereSpeciale){
        $sql = "SELECT * FROM perdorues WHERE email='$email' LIMIT 1";
        $rezultati = mysqli_query($conn, $sql);
        
        if (!mysqli_num_rows($rezultati) == 1) {
            $fjalekalim = md5($fjalekalim_1);
            $sql1 = "INSERT INTO perdorues (emriPlote, emerPerdoruesi, email, fjalekalimi)
                    VALUES ('$emriPlote', '$emerPerdoruesi', '$email', '$fjalekalim')";
            $rezultati1 = mysqli_query($conn, $sql1);
            if ($rezultati1) {
                $_SESSION['perdoruesi'] = $emerPerdoruesi;
                header("Location: form/form.html");
                /*$emriPlote = "";
                $emerPerdoruesi = "";
                $email = "";
                $_POST['pw1'] = "";
                $_POST['pw2'] = "";*/
            } else {
                array_push($errors, "Ooops!Pati nje problem!");
            }
        } else {
             array_push($errors, "Vendos nje email te ri!");
        }
        }else{array_push($errors, "Provo nje fjalekalim te ri.");}
        
    } else {

        array_push($errors, "Fjalekalimet nuk perputhen!");
    }
}
    


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Regjistrimi</title>
        <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
 integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="styles1.css">
    </head>
    <body>

    <div class="main1">
           <p class="sign" align="center">Sign up</p>
        <form action="signup.php" method="POST">
            <?php include('error.php'); ?>
      

                 <input class="un" type="text" placeholder="Full Name" name="emri" value="<?php echo $emriPlote ?>" required>
        

                 <input class="un" type="text" placeholder="Email" name="email"  value="<?php echo $email ?>"  required>
                
       
                <input class="un" type="text" placeholder="Username" name="perdoruesi" value="<?php echo $emerPerdoruesi ?>" required>
             
           
                <input class="pass" type="password" placeholder="Password" name="pw1" value="<?php echo $_POST['pw1']; ?>" required>
            

                <input class="pass" type="password" placeholder="Confirm Password" name="pw2" value="<?php echo $_POST['pw2']; ?>" required>
                

                 <button class="submit" align="center" type="submit" name="butoni2">Sign Up</button>
                <p class="forgot" align="center"><a href="signin.php">You already have an account?</p>
         
        </form>
       
    </div>

</body>
</html>
