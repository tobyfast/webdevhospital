<style>
    body {
      background-image: url('add.jpg');
    }
    </style>
<div class="top">
		<div>
		
		</div>
	</div>
	
	<div class="logo">
		<div>
			<table>
				<tr>

				<fieldset>
          <center><legend> <h1>Matter Hospital</h1></legend> </center>
					<td> <br> <br>
						<font size="4px"> 
							<a href="index.php">HOME</a> 
							<a href="create.php">ADD PATIENT</a>  
							<a href="delete.php">REMOVE PATIENT</a>
							<a href="read.php">FIND PATIENT</a> 
							<a href="update.php">UPDATE PATIENT</a>
						</font></fieldset>
					</td>
				</tr>
			</table>
		</div>
	</div>
<?php
if (isset($_POST['submit'])) {
 require "../common.php";
 try {
require_once '../src/DBconnect.php';
$new_user = array(
 "firstname" => $_POST['firstname'],
 "lastname" => $_POST['lastname'],
 "email" => $_POST['email'],
 "age" => $_POST['age'],
 "location" => $_POST['location']
);
$sql = sprintf(
 "INSERT INTO %s (%s) values (%s)",
 "users",
 implode(", ", array_keys($new_user)),
 ":" . implode(", :", array_keys($new_user))
);
$statement = $connection->prepare($sql);
$statement->execute($new_user);
 } catch(PDOException $error) {
 echo $sql . "<br>" . $error->getMessage();
 }
}
?>
<?php require "templates/header.php"; ?>
<?php if (isset($_POST['submit']) && $statement) { ?>
 <?php echo escape($_POST['firstname']); ?> successfully added.
<?php } ?>
<fieldset>
<legend><h2>Add a patient</h2></legend>
 <form method="post">
 <label for="firstname">First Name</label>
 <input type="text" name="firstname" id="firstname">
 <label for="lastname">Last Name</label>
 <input type="text" name="lastname" id="lastname">
 <label for="email">Email Address</label>
 <input type="text" name="email" id="email">
 <label for="age">Age</label>
 <input type="text" name="age" id="age">
 <label for="location">location</label>
 <input type="text" name="location" id="location">
 <input type="submit" name="submit" value="Submit">

 </form>
 <a href="index.php">home</a>
</fieldset>
<?php include "templates/footer.php"; ?> 