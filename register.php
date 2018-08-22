<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } 
			
			else{
                echo "Oops! Something went wrong. Please try again later.";
            }
			
			
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST['password']))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST['password'])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = 'Please confirm password.';     
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Password did not match.';
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="designreg.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
	<style>
.mySlides {display:none;}
</style>
</head>
<body>


<div class="box1">  

<div class="header-right">


<div>

<div class="para">
<a href="login.php"><img src="d1.png" class="logo"></a>
<a href="#default" class="go"><b>BAZOOKA</b></a>
    <a class="active" href="#home">Home</a>
    <a href="#contact">Contact</a>
    <a href="#about">About</a>
  </div>
  
</div>


</div>

<div class="slides">
  <img class="mySlides" src="5.jpg" style="width:100%">
  <img class="mySlides" src="6.jpg" style="width:100%">
  <img class="mySlides" src="7.jpg" style="width:100%">
</div>

<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 4000); // Change image every 2 seconds
}
</script>

    <div class="wrapper">
	<img src="d1.png" class="avtaar">
	
        <h2>Sign Up</h2>
		
        <p>Please fill this form to create an account.</p><br>
        
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <p>Username</p>
                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>   


			
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <p>Password</p>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
			
			
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <p>Confirm Password</p>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
			
			
			
            <div class="form-group">
                <input type="submit" class="button" style="vertical-align:middle" ><span></input>
				<br>
                <input type="reset" class="button" style="vertical-align:middle" ><span></input>
            </div>
			
			
			
			
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
		
		
    </div>
	
	
	
	<footer>

<div class= "box3">
<div class="row">
  <div class="column">
    <div class="card">
      <img src="219.jpeg" alt="Jane" class="profile">
      <div class="container">
        <h2>SACHIN DIWAKAR</h2>
        <p class="title">CEO & Founder</p>
        <p>2 yr C.S.E student at IIITDMJ</p>
        <p>2017219@iiitmj.ac.in</p>
        <p><button class="on">Contact</button></p>
      </div>
    </div>
  </div>

<div class="column">
    <div class="card">
      <img src="4.jpg" class="profile" alt="Mike">
      <div class="container">
        <h2>VIDUSHI DWIVEDI</h2>
        <p class="title">CO-FOUNDER</p>
        <p>2 yr C.C.E student at IIITDMJ.</p>
        <p>2017@iiitdmj.ac.in</p>
        <p><button class="on">Contact</button></p>
      </div>
    </div>
  </div>
  
  <div class="column">
    <div class="card">
      <img src="ceo.jpeg" alt="John" class="profile">
      <div class="container">
        <h2>Ashwani</h2>
        <p class="title">Designer</p>
        <p>2 yr C.S.E student at IIITDMJ.</p>
        <p>2017286@iiitdmj.ac.in</p>
        <p><button class="on">Contact</button></p>
      </div>
    </div>
  </div>

  </div>
  </div>
  </footer>

	
</body>
</html>