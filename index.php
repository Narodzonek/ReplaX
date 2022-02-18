<?php
/**
 * 2022
 * ReplaX program 
 * 
 * @author Damian Narodzonek
 * 
 * 
 */
require_once("replax_connect_class.php");
 /**
  * Global variables
  * 
  */
$replaxConnect = new ReplaXConnectDB();

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ReplaX</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        .display-4{font-size: 28px;}
        .replace-box{padding: 16px;}
    </style>
</head>
<body>
    <!-- Info -->
    <div class="container page-header">
        <div class="row">
            <div class="col-lg">
                <h1 class="display-1">ReplaX</h1>
                <p class="lead">
                    Mały program umożliwiający poprawę np. linków po przeniesieniu. <br> 
                    Daje również możliwość exportu wybranych tabel lub do pliku XML.    
                </p>
                <hr>
            </div>
        </div>
    </div>
    
    <!-- Database connection -->
    <div class="container">
        <h4 class="display-4">Połącz z bazą</h4>
        <form class="row" action="index.php" method="post">
            <div class="form-group col-sm">
                <label for="">Host:</label>
                <input type="text" class="form-control" name="dbHost" id="" aria-describedby="helpId" placeholder="">
                <small id="helpId" class="form-text text-muted">Help text</small>
            </div>
            <div class="form-group col-sm">
                <label for="">Database:</label>
                <input type="text" class="form-control" name="dbName" id="" aria-describedby="helpId" placeholder="">
                <small id="helpId" class="form-text text-muted">Help text</small>
            </div>
            <div class="form-group col-sm">
                <label for="">User:</label>
                <input type="text" class="form-control" name="dbUser" id="" aria-describedby="helpId" placeholder="">
                <small id="helpId" class="form-text text-muted">Help text</small>
            </div>
            <div class="form-group col-sm">
                <label for="">Password:</label>
                <input type="password" class="form-control" name="dbPass" id="" aria-describedby="helpId" placeholder="">
                <small id="helpId" class="form-text text-muted">Help text</small>
            </div>
            <div class="w-100"></div>
            <div class="col-2">
                <button type="submit" class="btn btn-primary">Connect</button>
            </div>
            <!-- alert-success, alert-danger, alert-warning -->
            <div class="col-10 alert <?php if($replaxConnect->connectionStatusAlert == 0){ ?> alert-warning
                <?php }elseif($replaxConnect->connectionStatusAlert == 3){ ?> alert-success
                <?php }else{ ?> alert-danger 
                <?php } ?>" role="alert">
                <?php echo $replaxConnect->connectionStatusAlert; ?>
            </div>
        </form>
        <?php
        
            if ($_SERVER["REQUEST_METHOD"] == "POST" && 
                !empty($_POST["dbHost"]) && !empty($_POST["dbName"]) && 
                !empty($_POST["dbUser"]) && !empty($_POST["dbPass"]) ) {

                    $replaxConnect->setDbConnection($_POST["dbHost"], $_POST["dbName"], $_POST["dbUser"], $_POST["dbPass"] );

                    echo print_r(PDO::getAvailableDrivers());
                    echo PDO::getAttribute(PDO::ATTR_DRIVER_NAME);
                    echo PDO::ATTR_CONNECTION_STATUS;

            }

        ?>
    </div>

    <!-- Replace content form -->
    <div class="replace-box container border border-secondary">
        <div class='row'>
            <div class="col-12">
                <h5 class="display-4">Znajdź i zamień</h5>  
            </div>
        </div>
        <form class="row" action="" method="post">
            <div class="form-group col-10">
            <label for=""></label>
            <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
            <small id="helpId" class="text-muted">Help text</small>
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>



    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" 
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
</body>
</html>