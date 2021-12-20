<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <script src="index.js"></script>
    <title>TODO</title>
</head>
<body>
    <div class="todos">
    <h1>Todos</h1>
    </div>
    <div class="forms">
        <label for="Todoitem">New Todo</label>
        <form action="#" class="form-group">
        <span id="error_text" class="text-danger">Please Enter to do item</span>
           <div class="inputs">
           <input type="text" autocomplete="off" onfocus="removeError()" name="toitems" id="toitems" class="form-control" placeholder="Enter your to do item here...">
            <button onclick="return getValidation()" name="submit"> <span>&plus;</span> Add</button>
           </div>
           <!-- Submit To Do items -->
            <?php
                if(isset($_GET['submit'])){
                    $connection = mysqli_connect("127.0.0.1","root","","todoitems");
                    $items = mysqli_real_escape_string($connection, $_GET['toitems']);
                    $itemid = uniqid(rand(0,1000));
                    $status = "pending";
                    if($connection){
                      $sql = "SELECT * FROM New_Items WHERE Items_name='{$items}'";
                      $query = mysqli_query($connection,$sql);
                      if($rows = mysqli_num_rows($query) > 0){
                         echo("<p class='text-danger'>This Item already added</p>");
                      }else{
                        $sql = "INSERT INTO New_Items(Item_Id,Items_name,Item_status)
                               VALUES('$itemid','$items','$status')";
                        $query = mysqli_query($connection,$sql);
                        if($query){
                            echo("<p class='text-success'>Item succesfully added</p>"); 
                        }else{
                            echo("<p class='text-danger'>Error adding your item, try again</p>");
                        }
                      }
                    }else{
                        echo("<p class='text-danger'>Cannot connect to the database</p>");
                    }
                }
            ?>
        </form>
    </div>
    <!-- Pending -->
    <div class="container" id="list_Items">
        <h4 class="text-secondary">Pending Items</h4>
              <!-- Get Items -->
              <?php
                   $connection = mysqli_connect("127.0.0.1","root","","todoitems");
                   $status = "pending";
                   $sql = "SELECT * FROM New_Items WHERE Item_status='{$status}'";
                   $query = mysqli_query($connection,$sql);
                   if($rows = mysqli_num_rows($query) > 0){
                      echo("<div class='flex_cards'>");
                      while($results = mysqli_fetch_array($query)){
                          $item = $results['Items_name'];
                          $id = $results['Item_Id'];
                          $statuses = $results['Item_status'];
                          echo("<div class='card' id='$id'>");
                          echo("<span class='$id'>$item</span>");
                          echo("<br>");
                          echo("<span>Status: <span class='text-primary'>$statuses</span></span>");
                          echo("<br>");
                          echo("<div class='controls'><input type='submit' class='btn btn-warning' onclick='getEditForms(this.id)' id='$id' value='Edit'><form><input type='submit' class='btn btn-success' id='$id' value='Mark Done' onclick='return setDone(this.id)' name='markdone'></form></div>");
                          echo("</div>");
                      }
                      echo("</div>");
                   }else{
                     echo("<p class='text-danger'>No Pending Items</p>");
                   }
              ?>
        </div>
    <!-- Done -->
    <div class="container" id="list_Items">
    <h4 class="text-secondary">Complete Items</h4>
              <!-- Get Items -->
              <?php
                   $connection = mysqli_connect("127.0.0.1","root","","todoitems");
                   $status = "complete";
                   $sql = "SELECT * FROM New_Items WHERE Item_status='{$status}'";
                   $query = mysqli_query($connection,$sql);
                   if($rows = mysqli_num_rows($query) > 0){
                      echo("<div class='flex_cards'>");
                      while($results = mysqli_fetch_array($query)){
                          $item = $results['Items_name'];
                          $id = $results['Item_Id'];
                          $statuses = $results['Item_status'];
                          echo("<div class='card' id='$id'>");
                          echo("<span class='$id'>$item</span>");
                          echo("<br>");
                          echo("<span>Status: <span class='text-success'>$statuses</span></span>");
                          echo("</div>");
                      }
                      echo("</div>");
                   }else{
                     echo("<p class='text-danger'>No Pending Items</p>");
                   }
              ?>
        </div>
        <div class="full_form" id="closeforms">
        <div class="rest_forms">
            <form action="#" class="form-group">
                <label for="">Edit Item</label>
                <span id="resetError" class="text-danger"></span>
                <div class="input_felx">
                <input type="text" name="resetitem" id="restitem" class="form-control">
                <button class="btn btn-primary" name="resetbtns" onclick="return validateReset()">Edit</button>
                </div>
            </form>
            <div class="btn btn-light"onclick="closeforms()">Close</div>
        </div>
        </div>
        <!-- reset forms -->
        <?php
            if(isset($_GET['resetbtns'])){
                $connection = mysqli_connect("127.0.0.1","root","","todoitems");
                $resetitem = mysqli_real_escape_string($connection, $_GET['resetitem']);
                $id = $_COOKIE['resetid'];
                $sql = "SELECT * FROM New_Items WHERE Item_Id='{$id}'";
                $query = mysqli_query($connection, $sql);
                if($rows = mysqli_num_rows($query) > 0){
                  $sql = "UPDATE New_Items SET Items_name='{$resetitem}' WHERE Item_Id='{$id}'";
                  $query = mysqli_query($connection, $sql);
                  if($query){
                    echo("<script>alert('Item updated succesfully')</script>");
                    header("location: index.php");
                  }else{
                    echo("<script>alert('Error updating this item')</script>");
                  }
                }else{
                    echo("<script>alert('Item dont exist')</script>");
                }
            }
        ?>
        <!-- mark as done -->
        <?php
          if(isset($_GET['markdone'])){
              $ids = $_COOKIE['doneItems'];
              $status = "complete";
              $sql = "SELECT * FROM New_Items WHERE Item_Id='{$ids}'";
                $query = mysqli_query($connection, $sql);
                if($rows = mysqli_num_rows($query) > 0){
                  $sql = "UPDATE New_Items SET Item_status='{$status}' WHERE Item_Id='{$ids}'";
                  $query = mysqli_query($connection, $sql);
                  if($query){
                    echo("<script>alert('Item updated succesfully')</script>");
                    header("location: index.php");
                  }else{
                    echo("<script>alert('Error updating this item')</script>");
                  }
                }else{
                    echo("<script>alert('Item dont exist')</script>");
                }
          }
        ?>
</body>
</html>