<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Task Manager | Add Task</title>
</head>
<body>
    <nav>
        <ul>
           <li> <a href="index.php">Home</a></li>
           <li><a href="addtask.php">Add</a></li>
           <li><a href="tasks.php">Tasks</a></li>
        </ul>
    </nav>
    <div class="container" id="flex-div">
       <div class="form">
       <h3>Added Task</h3>
       <form action="#" method="post" class="form-group">
           <div>
               <label for="taskname">Task</label>
               <input type="text" name="taskname" id="taskname" class="form-control" placeholder="Enter task">
           </div>
           <div>
               <label for="fromDate">From</label>
               <input type="date" name="fromDate" id="fromDate" class="form-control" placeholder="Enter start date">
           </div>
           <div>
               <label for="toDate">To</label>
               <input type="date" name="toDate" id="toDate" class="form-control" placeholder="Enter stop date">
           </div>
           <br>
           <br>
           <input type="submit" value="Add Task" class="btn btn-secondary">
        </form>
       </div>
       <div class="addedTitle">
           <h3>Added Task</h3>
       </div>
    </div>
</body>
</html>