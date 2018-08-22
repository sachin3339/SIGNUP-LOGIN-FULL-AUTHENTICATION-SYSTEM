
<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="profile.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
     <a href="www.google.com" >click here to see ur status</a>

    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>. Welcome to BAZOOKA.</h1>
    </div>
    <p><a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a></p>
	<div class="user" id="user">
	
	<div class="profile" >  <div></div>
	
	<form action="upload.php" method="post" enctype="multipart/form-data" class="upload">
			<input type="file" name ="file" class="file">
			<button type="submit" name="submit" class="submit">upload profile picture</button>
	 </form> 
	</div>
	
	
	<div class="below"> <div id="child"> <p class="title">YOUR CHILD PEFORMANCE</p></div></div>
	<div class="abc"id="abc"><h1>SUGGESTION BOX</h1><br><p>You can suggest manual task for your childern and we will make it for you </p><br>mail us at:2017219@iiitdmj.ac.in </div>
</body>
</html>