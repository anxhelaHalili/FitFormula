
<?php

include 'server.php';

error_reporting(0);
session_start();


if (isset($_POST['butoni1'])) {
    $emerPerdoruesi = strtolower($_POST['perdoruesi']);
    $fjalekalim = md5($_POST['pw']);

    $sql = "SELECT * FROM perdorues WHERE emerPerdoruesi='$emerPerdoruesi' AND fjalekalimi ='$fjalekalim'";
    $rezultati = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($rezultati);


    if (mysqli_num_rows($rezultati) == 1) {
        $_SESSION['perdoruesi'] = $emerPerdoruesi;
        header("Location: homepage/index.php");
    } else {
        array_push($errors, "Oops! Emaili ose Fjalekalimi gabim!");
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sign in</title>
        <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
 integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="styles1.css">
    </head>
    <body>
    <div class="main">
          <p class="sign" align="center">Sign in</p>
        <form  action="signin.php" class="form1" method="POST">
            <?php include('error.php'); ?>
        
                <input class="un" type="text" placeholder="Username" align="center" name="perdoruesi" value="<?php echo $emerPerdoruesi; ?>"required>   
          
                <input class="pass" type="password" id="id_password" placeholder="Password"  align="center" name="pw"  value="<?php echo $_POST['pw']; ?>" required>
                 <i class="far fa-eye" id="togglePassword" style="margin-left: -50px; cursor: pointer;"></i>
                 <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#id_password");

        togglePassword.addEventListener("click", function () {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            
            // toggle the icon
            this.classList.toggle("fa-eye-slash");
        });

        /* prevent form submit
        const form = document.querySelector("form");
        form.addEventListener('submit', function (e) {
            e.preventDefault();
        });*/
                 </script>
        
         <button class="submit" align="center" type="submit" name="butoni1">Sign in</button>
         <p class="forgot" align="center"><a href="signup.php">You don't have an account? Sign Up here!</a></p>
        </form>
        
    </div>
</body>
</html>
