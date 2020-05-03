<!DOCTYPE html>
  <html>
    <head>
      <title>Student Data</title>
      <link rel="stylesheet" type="text/css" href="resource/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="resource/mdb.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
  
      
    </head>
    <body>
       <?php require_once 'std_process.php'; ?>

    <?php if (isset($_SESSION['message'])): ?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>">
        <?php 
        echo $_SESSION['message'];
        unset($_SESSION['message']);


         ?>
    </div>
    <?php endif ?>


      <div class="wrapper-editor">

         <?php 
        $conn=mysqli_connect('localhost', 'root', '', 'mydata');
    if($conn->connect_error){
        echo "error";
    }

          $results = $conn->query("SELECT * from stdata");

     ?>

        <div class="block my-4">
          <div class="d-flex justify-content-center">
            <p class="h5 text-primary createShowP">Skill Class Student Data</p>
          </div>
        </div>


        <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th class="th-sm">ID

              </th>
              <th class="th-sm">NAME

              </th>
              <th class="th-sm">USERNAME

              </th>
              <th class="th-sm">PASSWORD

              </th>
              <th class="th-sm">CREATED DATE

              </th>
              <th class="th-sm">LOGIN

              </th>
              <th class="th-sm">COURSE

              </th>
              <th class="th-sm" colspan="2">ACTION

              </th>
            </tr>
          </thead>
          <tbody>
           
           <!--  <button class="btn btn-danger btn-sm btn-rounded buttonDelete edit">edit</button> -->
           
            <?php 
               while ($row = mysqli_fetch_assoc($results)): ?>
                 <tr>
               <td><?php echo $row['id'];  ?></td><td><?php echo $row['name'];  ?></td>
                      <td><?php echo $row["username"];  ?></td>
                       <td><?php echo $row["password"];  ?></td>
                      <td><?php echo $row["created"];  ?></td>
                        <td><?php echo $row["login"];  ?></td>
                      <td><?php echo $row["course"];  ?></td>
                  <td>
                    <input type="button" name="edit" value="Edit" id="<?php echo $row['id'];?>" class="btn btn-info btn-sm btn-rounded view" data-toggle="modal" data-target="#update"/>

                    <a href="studentData.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm btn-rounded">Delete</a></td>
                  </tr>
              <?php endwhile; ?>
          </tbody>
        </table>


        <div class="row d-flex justify-content-center modalWrapper">
          
          <div class="modal fade modalEditClass" id="update" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header text-center">
                  <h4 class="modal-title w-100 font-weight-bold text-secondary ml-5">Edit form</h4>
                  <button type="button" class="close text-secondary" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body mx-3" >
                  <form action="std_process.php" method="POST" id="respo">
                    





                  </form>
                </div>
              </div>
            </div>
          </div>

      </div>




<script type="text/javascript">

$('.view').click(function() {
var id = $(this).attr("id");  
    $.ajax({
        type: 'POST',
        url: 'std_process.php',
        data: { id: id},
        success: function(response) {
            $('#respo').html(response);
        }
    });
});


$('#updateData').click(function() {  
var id=document.getElementById("stid").value; 
var name=document.getElementById("stname").value; 
var username=document.getElementById("stusername").value; 
var pass=document.getElementById("stpass").value;  
var created=document.getElementById("stcreated").value;  
var login=document.getElementById("stlogin").value;  
var course=document.getElementById("stcourse").value;  
    $.ajax({
        type: 'POST',
        url: 'std_process.php',
        data: { id:id,name:name,username:username,pass:pass,created:created,login:login,course:course},
        success: function(response) {
            $('#respo').html(response);
        }
    });
});
     
</script>

      <script type="text/javascript" src="resource/jquery.min.js"></script>
      <script type="text/javascript" src="resource/bootstrap.min.js"></script>

      


    </body>
  </html>