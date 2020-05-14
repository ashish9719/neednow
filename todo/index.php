<!DOCTYPE HTML>
<html>
<head>
  <title>TODO</title>
  <meta name=viewport content='width=640'>
  <link rel="shortcut icon" href="images/favicon.png">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css">
  <link rel="stylesheet" href="jquery/css/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="/neednow/home/style.css">

  <script src="jquery/js/jquery.js"></script>
  <script src="jquery/js/jquery-ui.js"></script>
  <script src="js/script.js"></script>
</head>
<body>

  
<input type="checkbox" id="check">
    <label for="check">
      <i class="fas fa-bars" id="btn"></i>
      <i class="fas fa-times" id="cancel"></i>
    </label>
    <div class="sidebar">
    <header>NeedNow</header>
  <ul>
<li><a href="/neednow/home/index.html"><i class="fas fa-qrcode"></i>Home</a></li>
<li><a href="/neednow/calculator/index.html"><i class="fas fa-link"></i>Calculator</a></li>
<li><a href="/neednow/todo/index.php"><i class="fas fa-stream"></i>ToDo</a></li>
<li><a href="/neednow/weather/index.html"><i class="fas fa-calendar-week"></i>Weather</a></li>
<li><a href="/neednow/about.html"><i class="far fa-question-circle"></i>About</a></li>
</ul>
</div>
  <div class="container">
    <div class="hero-unit">
      <img class="img-responsive" src="images/TODO.png">
    </div>

    <div class="row">
      <div class="span6">
        <legend>TODO List</legend>
        <?php
        include("dbconnect.php");
        $x = mysqli_query($con, "SELECT * FROM todo WHERE `todo`.`done`=0 ORDER BY `date`");
        echo "
        <table class='table table-hover'>
          <thead>
            <tr>
              <th>Description</th>
              <th>Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          ";
        if(mysqli_num_rows($x) == 0) {
          echo "<tr>";
          echo "<td>Sorry no todo to display :-(</td>";
          echo "<td>-</td>";
          echo "<td>-</td>";
          echo "</tr>";
        }
        else {
          date_default_timezone_set($time_zone);

          while($row = mysqli_fetch_array($x)) {
            $d = date('Y-m-d');
            if($d == $row['date']) {
              $display_date = 'Today';
            }
            else {
              $display_date = $row['date'];
            }
            echo "<tr>";
            echo "<td>".$row['desc']."</td>";
            echo "<td>".$display_date."</td>";
            echo "<td><a href='done_todo.php?id=".$row['id']."'>done</a> | <a href='edit_todo.php?id=".$row['id']."'>edit</a> | <a href='del_todo.php?id=".$row['id']."'>delete</a>";
            echo "</tr>";
          }
        }

        $x = mysqli_query($con, "SELECT * FROM todo WHERE `todo`.`done`=1");
        if(mysqli_num_rows($x) == 0) {
          echo "</tbody>";
          echo "</table>";
        }
        else {
          while($row = mysqli_fetch_array($x)) {
            echo "<tr>";
            echo "<td><strike>".$row['desc']."</strike></td>";
            echo "<td><strike>".$row['date']."</strike></td>";
            echo "<td><a href='del_todo.php?id=".$row['id']."'>delete</a>";
            echo "</tr>";
          }
          echo "</tbody>";
          echo "</table>";
        }

        mysqli_close($con);
        ?>
      </div>

      <div class="span3">
        <form class="form-search form-myform" action="add_todo.php" method="post">
          <fieldset>
            <h3>Add new TODO</h3>
            <div class="">
              <input class="input-block-level" type="text" name="desc" placeholder="Description..." />
              <input class="input-block-level" type="text" name="date" placeholder="Date..." id="datepicker" />
              <input class="btn btn-large btn-primary" type="submit" value="Add">
            </div>
          </fieldset>
        </form>
      </div>

      <div class="span3">
        <?php
        include("dbconnect.php");
        $x = mysqli_query($con, "SELECT * FROM scrap");
        if(mysqli_num_rows($x) == 0) {
          echo "
          <form class='form-search form-myform' action='savescrap.php' method='post'>
            <fieldset>
              <h3>Scrap Pad</h3>
              <div class=''>
                <textarea id='scrap' name='scrap'></textarea>
                <input class='btn btn-large btn-primary' type='submit' value='Save'>
              </div>
            </fieldset>
          </form>
          ";
        }
        else {
          $row = mysqli_fetch_array($x);
          echo "
          <form class='form-search form-myform' action='savescrap.php' method='post'>
            <fieldset>
              <h3>Scrap Pad</h3>
              <div class=''>
                <textarea id='scrap' name='scrap'>".$row['desc']."</textarea>
                <input class='btn btn-large btn-primary' type='submit' value='Save'>
              </div>
            </fieldset>
          </form>
          ";
        }

        mysqli_close($con);
        ?>
      </div>

    </div>
  </div>

  <script src="bootstrap/js/bootstrap.js"></script>
</body>
</html>
