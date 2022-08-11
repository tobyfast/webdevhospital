<style>
    body {
      background-image: url('update.jpg');
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
 * List all users with a link to edit
 */
try {
 require "../common.php";
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
<h2>Update patients</h2>
<table>
 <thead>
 <tr>
 <th>#</th>
 <th>First Name</th>
 <th>Last Name</th>
 <th>Email Address</th>
 <th>Age</th>
 <th>Location</th>
 <th>Date</th>
 <th>Edit</th>
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
 <td><a href="update-single.php?id=<?php echo escape($row["id"]);?>">Edit</a></td>
 </tr>
 <?php endforeach; ?>
 </tbody>
</table>
<a href="index.php">Back to home</a>
<?php require "templates/footer.php"; ?>