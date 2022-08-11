<style>
    body {
      background-image: url('bye.jpg');
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
          <center> <h1>Matter Hospital</h1> </center>
					<td> <br> <br>
						<font size="4px"> 
							<a href="index.php">HOME</a> 
							<a href="create.php">ADD PATIENT</a>  
							<a href="delete.php">REMOVE PATIENT</a>
							<a href="read.php">FIND PATIENT</a> 
							<a href="update.php">UPDATE PATIENT</a>
						</font>
					</td>
				</tr>
			</table>
		</div>
	</div>
<?php
/**
 * Delete a user
 */
require "../common.php";
if (isset($_GET["id"])) {
 try {
 require_once '../src/DBconnect.php';

 $id = $_GET["id"];

 $sql = "DELETE FROM users WHERE id = :id";

 $statement = $connection->prepare($sql);
 $statement->bindValue(':id', $id);
 $statement->execute();

 $success = "User successfully deleted";

 } catch(PDOException $error) {
 echo $sql . "<br>" . $error->getMessage();
 }
}
try {
 require_once '../src/DBconnect.php';
 $sql = "SELECT * FROM users";
 $statement = $connection->prepare($sql);
 $statement->execute();
 $result = $statement->fetchAll();
} catch(PDOException $error) {
 echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "templates/header.php"; ?>
<h2>Delete patients</h2>
<?php if ($success) echo $success; ?>
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
 <th>Delete</th>
 </tr>
 </thead>
 <tbody>
    
 <?php foreach ($result as $row) : ?>
 <tr>
 <td><?php echo escape($row["id"]); ?></td>
 <td><?php echo escape($row["firstname"]); ?></td>
 <td><?php echo escape($row["lastname"]); ?></td>
 <td><?php echo escape($row["email"]); ?></td>
 <td><?php echo escape($row["age"]); ?></td>
 <td><?php echo escape($row["location"]); ?></td>
 <td><?php echo escape($row["date"]); ?> </td>
 <td><a href="delete.php?id=<?php echo escape($row["id"]);
?>">Delete</a></td>
 </tr>
 <?php endforeach; ?>
 </tbody>
</table>
<a href="index.php">home</a>
<?php require "templates/footer.php"; ?>