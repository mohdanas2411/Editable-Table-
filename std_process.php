<?php  
	session_start();

	 $conn=mysqli_connect('localhost', 'root', '', 'myData');
    if($conn->connect_error){
        echo "error";
    } 
   	
   	$id = 0;
   	$name = '';
   	$pass = '';

	if (isset($_GET['delete'])) {

		$id = $_GET['delete'];

		$conn->query("DELETE FROM stdata where id = $id");

		$_SESSION['message'] = "Record has been Updated";
		$_SESSION['msg_type'] = "danger";

		header('location: studentData.php');

	}


	if(isset($_GET['edit'])){
		$id = $_GET['edit'];

		
		$result = $conn->query("SELECT * FROM stdata WHERE id = $id");

		$row = mysqli_fetch_array($result);

		if (mysqli_num_rows($result) == 1) {
			
			// $name = $row['studentName'];
			// $pass = $row['pass'];
		}
	}


	if(isset($_POST['id'])){
		$id = $_POST['id'];
		
		     // $result = $conn->query("SELECT * FROM stdata WHERE id = '".$_POST["id"]."'");  
		// ("SELECT * FROM stdata WHERE id = $id");

		      $query = "SELECT * FROM stdata WHERE id = '".$_POST["id"]."'";  
      $result = mysqli_query($conn, $query);  
      // $row = mysqli_fetch_array($result);  
      // echo json_encode($row);  
		$row = mysqli_fetch_array($result);

		if (mysqli_num_rows($result) == 1) {
			

		}

		$respo = ' <input type="hidden" name="id" id="stid"  value="' . $row["id"] . '">
                <div class="form-group">
                <label for="stname">Name :</label>
                    <input type="text" name="name" id="stname" class="form-control" value="' . $row["name"] . '"  placeholder="name">
                </div>
                 <div class="form-group">
                 <label for="stusername">User Name :</label>
                    <input type="text" name="username" id="stusername" class="form-control" value="'.$row["username"].'" placeholder="username">
                </div>
                  <div class="form-group">
                  <label for="stpass">Password:</label>
                    <input type="text" name="pass" id="stpass" class="form-control" value="'.$row["password"].'" placeholder="pass">
                </div>
                 <div class="form-group">
                    <input type="hidden" name="date" id="stcreated" class="form-control" value="'.$row["created"].'" placeholder="date">
                </div>
                <div class="form-group">
                    <input type="hidden" name="login" id="stlogin" class="form-control" value="'.$row["login"].'" placeholder="login">
                </div>
                  <div class="form-group">
                  <label for="stcourse">User Course:</label>
                    <input type="text" name="course" id="stcourse" class="form-control" value="'.$row["course"].'" placeholder="course">
                </div>

                 <div class="form-group">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="update" id="updateData" class="btn btn-primary">Update</button>
                </div>';

                echo $respo;
	}

	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$name = $_POST['name'];
		$username = $_POST['username'];
		$password = $_POST['pass'];
		$created = $row['created'];
		$login = $row['login'];
		$course = $_POST['course'];

		$conn->query("UPDATE stdata SET name= '$name', username = '$username' , password = '$password' , created = '$created' , login = '$login' , course = '$course' WHERE id = $id ");
		

		$_SESSION['message'] = "Record has been Updated";
		$_SESSION['msg_type'] = "warning";

		header('location: studentData.php');
	}

?>