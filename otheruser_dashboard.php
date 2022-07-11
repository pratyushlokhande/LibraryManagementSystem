<?php

session_start();

$userloginid = $_SESSION["userid"] = $_GET['userlogid'];
// echo $_SESSION["userid"];


?>


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&display=swap" rel="stylesheet">

</head>
<style>
    *,
    *::before,
    *::after {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        width: 100%;
        height: 100vh;
        background-color: #000000;
        background-image: url("images/library.jpg");
        background-size: cover;
        background-position: center;
        color: #ffffff !important;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: 'Playfair Display', serif;
        font-weight: 600;
    }

    .heading {
        font-family: 'Playfair Display', serif;
        font-weight: 800;
        font-size: 5rem;
    }

    .blur {
        background: rgba(0, 0, 0, 0.25);

        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
        border-radius: 5px;
        border: 1px solid rgba(255, 255, 255, 0.18);
        color: #ffffff;
    }

    table {
        color: #ffffff;
    }
</style>

<script defer>
    function togglePortion(portion) {
        var i;
        var x = document.getElementsByClassName("portion");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        document.getElementById(portion).style.display = "block";
    }
</script>

<body>

    <?php
    include("data_class.php");
    ?>
    <main class="container-fluid p-2">
        <div class="d-flex w-100 justify-content-center px-2 py-5 heading blur">
            <h1 class="text-white">DIGITAL LIBRARY</h1>
        </div>
        <h3 class="text-center my-2 py-2 blur" style="background-color: rgba(0, 0, 0, 0.8);">STUDENT</h3>
        <div class="row m-1 px-2 py-4 blur" style="background-color: rgba(0, 0, 0, 0.8);">
            <div class="col-md-3">
                <!-- <button class="btn w-100 my-1 blur">Welcome</button> -->
                <button class="btn btn-primary w-100 my-1 blur" onclick="togglePortion('myaccount')"> My Account</button>
                <button class="btn btn-primary w-100 my-1 blur" onclick="togglePortion('requestbook')"> Request Book</button>
                <button class="btn btn-primary w-100 my-1 blur" onclick="togglePortion('issuereport')"> Book Report</button>
                <a class="mt-3 btn btn-primary btn-danger w-100 blur fw-bold" style="background-color: rgba(255, 0, 0, 0.5);" href="index.php">LOGOUT</a>
            </div>

            <div class="col-md-9">

                <div id="myaccount" class="container-fluid w-100 portion">
                    <div class="w-100 p-1">
                        <h3 class="w-100 text-center rounded py-3 blur" style="background-color: rgba(0, 53, 102, 0.5);">My Account</h3>
                        <?php

                        $u = new data;
                        $u->setconnection();
                        $u->userdetail($userloginid);
                        $recordset = $u->userdetail($userloginid);
                        foreach ($recordset as $row) {

                            $id = $row[0];
                            $name = $row[1];
                            $email = $row[2];
                            $pass = $row[3];
                            $type = $row[4];
                        }
                        ?>

                        <div class="row">
                            <p class="col-md-4"><b>PERSON NAME :</b> &nbsp&nbsp<?php echo $name ?></p>
                            <p class="col-md-4"><b>PERSON EMAIL :</b> &nbsp&nbsp<?php echo $email ?></p>
                            <p class="col-md-4"><b>PERSON TYPE :</b> &nbsp&nbsp<?php echo $type ?></p>
                        </div>

                    </div>
                </div>

                <div id="issuereport" class="container-fluid w-100 portion" style="display:none">
                    <div class="w-100 p-1">
                        <h3 class="w-100 text-center rounded py-3 blur" style="background-color: rgba(0, 53, 102, 0.5);">ISSUE REPORT</h3>

                        <?php

                        $userloginid = $_SESSION["userid"] = $_GET['userlogid'];
                        $u = new data;
                        $u->setconnection();
                        $u->getissuebook($userloginid);
                        $recordset = $u->getissuebook($userloginid);

                        $table = "<table class='table text-white'>
                                    <thead class='thead-dark'>
                                        <tr>
                                            <th scope='col'>Name</th>
                                            <th scope='col'>Book Name</th>
                                            <th scope='col'>Issue Date</th>
                                            <th scope='col'>Return Date</th>
                                            <th scope='col'>Fine</th>
                                            <th scope='col'>Return</th>
                                        </tr>
                                    </thead><tbody>";

                        foreach ($recordset as $row) {
                            $table .= "<tr>";
                            // $table .= "<td scope='col'>$row[0]</td>";
                            $table .= "<td scope='col'>$row[2]</td>";
                            $table .= "<td scope='col'>$row[3]</td>";
                            $table .= "<td scope='col'>$row[6]</td>";
                            $table .= "<td scope='col'>$row[7]</td>";
                            $table .= "<td scope='col'>$row[8]</td>";
                            $table .= "<td scope='col'><a class='btn btn-success' href='otheruser_dashboard.php?returnid=$row[0]&userlogid=$userloginid'>Return</a></td>";
                            $table .= "</tr>";
                            // $table.=$row[0];
                        }
                        $table .= "</tbody></table>";

                        echo $table;
                        ?>

                    </div>
                </div>


                <div id="requestbook" class="container-fluid w-100 portion" style="display:none">
                    <div class="w-100 p-1">
                        <h3 class="w-100 text-center rounded py-3 blur" style="background-color: rgba(0, 53, 102, 0.5);">REQUEST BOOK</h3>

                        <?php
                        $u = new data;
                        $u->setconnection();
                        $u->getbookissue();
                        $recordset = $u->getbookissue();

                        $table = "<table class='table text-white'>
                                <thead class='thead-dark'>
                                <tr>
                                    <th scope='col'>Image</th>
                                    <th scope='col'>Book Name</th>
                                    <th scope='col'>Book Authour</th>
                                    <th scope='col'>branch</th>
                                    <th scope='col'>price</th>
                                    <th scope='col'>Request Book</th>
                                </tr>
                                </thead><tbody>";

                        foreach ($recordset as $row) {
                            $table .= "<tr>";
                            // $table .= "<td scope='col'>$row[0]</td>";
                            $table .= "<td scope='col'><img src='uploads/$row[1]' width='50px' height='50px' style='border:1px solid #333333; border-radius: 50%'></td>";
                            $table .= "<td scope='col'>$row[2]</td>";
                            $table .= "<td scope='col'>$row[4]</td>";
                            $table .= "<td scope='col'>$row[6]</td>";
                            $table .= "<td scope='col'>$row[7]</td>";
                            $table .= "<td scope='col'><a class='btn btn-success' href='requestbook.php?bookid=$row[0]&userid=$userloginid'>Request Book</a></td>";

                            $table .= "</tr>";
                            // $table.=$row[0];
                        }
                        $table .= "</tbody></table>";

                        echo $table;


                        ?>

                    </div>
                </div>

            </div>

        </div>
    </main>
</body>

</html>