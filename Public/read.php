<style>
    body {
      background-image: url('find.jpg');
      background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
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
						</font>
</fieldset>
					</td>
				</tr>
			</table>
		</div>
	</div>
<?php
/**
 * Function to query information based on
 * a parameter: in this case, location.
 *
 */
if (isset($_POST['submit'])) {
 try {
 require "../common.php";
 require_once '../src/DBconnect.php';
 $sql = "SELECT *
 FROM users
 WHERE lastname = :lastname";
 $lastname = $_POST['lastname'];
 $statement = $connection->prepare($sql);
 $statement->bindParam(':lastname', $lastname, PDO::PARAM_STR);
 $statement->execute();
 $result = $statement->fetchAll();
 } catch(PDOException $error) {
 echo $sql . "<br>" . $error->getMessage();
 }
}
require "templates/header.php";
if (isset($_POST['submit'])) {
 if ($result && $statement->rowCount() > 0) {
?>
 <h2>Results</h2>
 <table>
 <thead>
<tr>
 <th>#</th>
 <th>First Name</th>
 <th>Last Name</th>
 <th>Email Address</th>
 <th>Age</th>
 <th>location</th>
 <th>Date</th>
</tr>
 </thead>
 <tbody>
    
 <?php foreach ($result as $row) { ?>
 <tr>
<td><?php echo escape($row["id"]); ?></td>
<td><?php echo escape($row["firstname"]); ?></td>
<td><?php echo escape($row["lastname"]); ?></td>
<td><?php echo escape($row["email"]); ?></td>
<td><?php echo escape($row["age"]); ?></td>
<td><?php echo escape($row["location"]); ?></td>
<td><?php echo escape($row["date"]); ?> </td>
 </tr>
 <?php } ?>
 </tbody>
 </table>
 <?php } else { ?>
 > No results found for <?php echo escape($_POST['lastname']); ?>.
 <?php }
} ?>
<h2>Find patient based on last name</h2>
<form method="post">
 <label for="lastname">Last name</label>
 <input type="text" id="lastname" name="lastname">
 <input type="submit" name="submit" value="View Results">
</form>
<a href="index.php">home</a>
<?php require "templates/footer.php"; ?>