<!DOCTYPE html>
<html lang="en">
!
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Dashboard</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
        color: #fff;
        background-image: url("images/library.jpg");
        background-size: cover;
        background-position: center;
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
    }
</style>

<body>

    <?php
    include("data_class.php");

    $msg = "";

    if (!empty($_REQUEST['msg'])) {
        $msg = $_REQUEST['msg'];
    }

    if ($msg == "done") {
        echo "<div class='alert alert-success' role='alert'>Sucssefully Done</div>";
    } elseif ($msg == "fail") {
        echo "<div class='alert alert-danger' role='alert'>Fail</div>";
    }

    ?>



    <main class="container-fluid p-2">
        <div class="d-flex w-100 justify-content-center px-2 py-5 heading blur">
            <h1 class="text-white">DIGITAL LIBRARY</h1>
        </div>
        <h3 class="text-center my-2 py-2 blur" style="background-color: rgba(0, 0, 0, 0.8);">ADMIN</h3>
        <div class="row m-1 px-2 py-4 blur" style="background-color: rgba(0, 0, 0, 0.8);">
            <div class="col-md-3">
                <button class="btn btn-primary w-100 my-1 blur" onclick="openpart('addbook')">ADD BOOK</button>
                <button class="btn btn-primary w-100 my-1 blur" onclick="openpart('bookreport')"> BOOK REPORT</button>
                <button class="btn btn-primary w-100 my-1 blur" onclick="openpart('bookrequestapprove')"> BOOK REQUESTS</button>
                <button class="btn btn-primary w-100 my-1 blur" onclick="openpart('addperson')"> ADD STUDENT</button>
                <button class="btn btn-primary w-100 my-1 blur" onclick="openpart('studentrecord')"> STUDENT REPORT</button>
                <button class="btn btn-primary w-100 my-1 blur" onclick="openpart('issuebook')"> ISSUE BOOK</button>
                <button class="btn btn-primary w-100 my-1 blur" onclick="openpart('issuebookreport')"> ISSUE REPORT</button>
                <a class="mt-3 btn btn-danger w-100 blur fw-bold" style="background-color: rgba(255, 0, 0, 0.5);" href="index.php">LOGOUT</a>
            </div>
            <div class=" col-md-9">

                <!-- == Book Request Approve Start == -->
                <div id="bookrequestapprove" class="container-fluid w-100 portion" style="display:none">
                    <div class="w-100 py-1">
                        <h3 class="w-100 text-center rounded py-3 blur" style="background-color: rgba(0, 53, 102, 0.5);">ROOK REQUEST APPROVE</h3>
                        <?php
                        $u = new data;
                        $u->setconnection();
                        $u->requestbookdata();
                        $recordset = $u->requestbookdata();
                        $table = "<table class='table text-white'><thead class='thead-dark'><tr><th scope='col'>Person Name</th><th scope='col'>person type</th><th scope='col'>Book name</th><th scope='col'>Days </th><th scope='col'>Approve</th></tr></thead><tbody>";
                        foreach ($recordset as $row) {
                            $table .= "<tr>";
                            "<td scope='col'>$row[0]</td>";
                            "<td scope='col'>$row[1]</td>";
                            "<td scope='col'>$row[2]</td>";
                            $table .= "<td scope='col'>$row[3]</td>";
                            $table .= "<td scope='col'>$row[4]</td>";
                            $table .= "<td scope='col'>$row[5]</td>";
                            $table .= "<td scope='col'>$row[6]</td>";
                            // $table.="<td><a href='approvebookrequest.php?reqid=$row[0]&book=$row[5]&userselect=$row[3]&days=$row[6]'><button type='button' class='btn btn-primary'>Approved BOOK</button></a></td>";
                            $table .= "<td scope='col'><a href='approvebookrequest.php?reqid=$row[0]&book=$row[5]&userselect=$row[3]&days=$row[6]'>Approved</a></td>";
                            // $table.="<td><a href='deletebook_dashboard.php?deletebookid=$row[0]'>Delete</a></td>";
                            $table .= "</tr>";
                            // $table.=$row[0];
                        }
                        $table .= "</tbody></table>";
                        echo $table;
                        ?>
                    </div>
                </div>
                <!-- == Book Request Approve End == -->

                <!-- == Add Book Start == -->
                <div id="addbook" class="container-fluid w-100 portion">
                    <div class="w-100 py-1">
                        <h3 class="w-100 text-center rounded py-3 blur" style="background-color: rgba(0, 53, 102, 0.5);">ADD NEW BOOK</h3>
                        <form class="row py-2" action="addbookserver_page.php" method="post" enctype="multipart/form-data">
                            <div class="form-group my-1 col-md-6">
                                <label for="bookname">Book Name:</label>
                                <input id="bookname" type="text" name="bookname" class="form-control blur" placeholder="Enter Book Name" />
                            </div>
                            <div class="form-group my-1 col-md-6">
                                <label for="detail">Book Detail</label>
                                <input id="detail" type="text" name="bookdetail" class="form-control blur" placeholder="Enter Book Detail" />
                            </div>
                            <div class="form-group my-1 col-md-6">
                                <label for="author">Book Author</label>
                                <input id="author" type="text" name="bookauthor" class="form-control blur" placeholder="Enter Book Author" />
                            </div>
                            <div class="form-group my-1 col-md-6">
                                <label for="publication">Book Publication</label>
                                <input id="publication" type="text" name="bookpublication" class="form-control blur" placeholder="Enter Book Publication" />
                            </div>
                            <div class="form-group my-1 col-md-6">
                                <label>Branch</label>
                                <div class="row px-3">
                                    <div class="form-check col-sm-6">
                                        <input type="radio" name="branch" value="other" class="form-check-input blur">
                                        <label class="form-check-label">Other</label>
                                    </div>
                                    <div class="form-check col-sm-6">
                                        <input type="radio" name="branch" value="BSIT" class="form-check-input blur">
                                        <label class="form-check-label">BSIT</label>
                                    </div>
                                    <div class="form-check col-sm-6">
                                        <input type="radio" name="branch" value="BSCS" class="form-check-input blur">
                                        <label class="form-check-label">BSCS</label>
                                    </div>
                                    <div class="form-check col-sm-6">
                                        <input type="radio" name="branch" value="BSSE" class="form-check-input blur">
                                        <label class="form-check-label">BSSE</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group my-1 col-md-6">
                                <label for="price">Book Price</label>
                                <input id="price" type="number" name="bookprice" class="form-control blur" placeholder="Enter Book Price" />
                            </div>
                            <div class="form-group my-1 col-md-6">
                                <label for="quantity">Book Quantity</label>
                                <input id="quantity" type="number" name="bookquantity" class="form-control blur" placeholder="Enter Book Quantity" />
                            </div>
                            <div class="form-group my-1 col-md-6">
                                <label for="file">Book Photo</label>
                                <input id="file" type="file" name="bookphoto" class="form-control blur" />
                            </div>
                            <input class="btn btn-success mx-3 my-3 w-auto" type="submit" value="SUBMIT" />
                        </form>
                    </div>
                </div>
                <!-- == Add Book End == -->

                <!-- == Add Person Start == -->
                <div id="addperson" class="container-fluid w-100 portion" style="display:none">
                    <div class="w-100 py-1">
                        <h3 class="w-100 text-center rounded py-3 blur" style="background-color: rgba(0, 53, 102, 0.5);">ADD PERSON</h3>
                        <form class="row py-2" action="addpersonserver_page.php" method="post" enctype="multipart/form-data">
                            <div class="form-group my-1 col-md-6">
                                <label>Name</label>
                                <input type="text" name="addname" class="form-control blur" placeholder="Enter Name" />
                            </div>
                            <div class="form-group my-1 col-md-6">
                                <label>Password</label>
                                <input type="password" name="addpass" class="form-control blur" placeholder="Enter Password" />
                            </div>
                            <div class="form-group my-1 col-md-6">
                                <label>Email</label>
                                <input type="email" name="addemail" class="form-control blur" placeholder="Enter Email" />
                            </div>
                            <div class="form-group my-1 col-md-6">
                                <label>Branch</label>
                                <div class="row px-3">
                                    <div class="form-check col-sm-6">
                                        <input type="radio" name="type" value="teacher" class="form-check-input blur">
                                        <label class="form-check-label">Teacher</label>
                                    </div>
                                    <div class="form-check col-sm-6">
                                        <input type="radio" name="type" value="student" class="form-check-input blur">
                                        <label class="form-check-label">Student</label>
                                    </div>
                                </div>
                            </div>
                            <input class="btn btn-success mx-3 my-3 w-auto" type="submit" value="SUBMIT" />
                        </form>
                    </div>
                </div>
                <!-- == Add Person End == -->

                <!-- == Student Record Start == -->
                <div id="studentrecord" class="container-fluid w-100 portion" style="display:none">
                    <div class="w-100 py-1">
                        <h3 class="w-100 text-center rounded py-3 blur" style="background-color: rgba(0, 53, 102, 0.5);">STUDENT RECORD</h3>
                        <?php
                        $u = new data;
                        $u->setconnection();
                        $u->userdata();
                        $recordset = $u->userdata();
                        $table = "<table class='table text-white'>
                        <thead class='thead-dark'>
                            <tr>
                                <th scope='col'>Name</th>
                                <th scope='col'>Email</th>
                                <th scope='col'>Type</th>
                            </tr>
                        </thead><tbody>";
                        foreach ($recordset as $row) {
                            $table .= "<tr>";
                            "<td scope='col'>$row[0]</td>";
                            $table .= "<td scope='col'>$row[1]</td>";
                            $table .= "<td scope='col'>$row[2]</td>";
                            $table .= "<td scope='col'>$row[4]</td>";
                            // $table.="<td><a href='deleteuser.php?useriddelete=$row[0]'>Delete</a></td>";
                            $table .= "</tr>";
                            // $table.=$row[0];
                        }
                        $table .= "</tbody></table>";
                        echo $table;
                        ?>
                    </div>
                </div>
                <!-- == Student Record End == -->

                <!-- == Issue Book Report Start == -->
                <div id="issuebookreport" class="container-fluid w-100 portion" style="display:none">
                    <div class="w-100 py-1">
                        <h3 class="w-100 text-center rounded py-3 blur" style="background-color: rgba(0, 53, 102, 0.5);">ISSUE BOOK RECORD</h3>
                        <?php
                        $u = new data;
                        $u->setconnection();
                        $u->issuereport();
                        $recordset = $u->issuereport();
                        $table = "<table class='table text-white'>
                        <thead class='thead-dark'>
                            <tr>
                                <th scope='col'>Issue Name</th>
                                <th scope='col'>Book Name</th>
                                <th scope='col'>Issue Date</th>
                                <th scope='col'>Return Date</th>
                                <th scope='col'>Fine</th>
                                <th scope='col'>Issue Type</th>
                            </tr>
                        </thead><tbody>";
                        foreach ($recordset as $row) {
                            $table .= "<tr>";
                            "<td scope='col'>$row[0]</td>";
                            $table .= "<td scope='col'>$row[2]</td>";
                            $table .= "<td scope='col'>$row[3]</td>";
                            $table .= "<td scope='col'>$row[6]</td>";
                            $table .= "<td scope='col'>$row[7]</td>";
                            $table .= "<td scope='col'>$row[8]</td>";
                            $table .= "<td scope='col'>$row[4]</td>";
                            // $table.="<td><a href='otheruser_dashboard.php?returnid=$row[0]&userlogid=$userloginid'>Return</a></td>";
                            $table .= "</tr>";
                            // $table.=$row[0];
                        }
                        $table .= "</tbody></table>";
                        echo $table;
                        ?>
                    </div>
                </div>
                <!-- == Issue Book Report End == -->

                <!-- == Issue Book Start == -->
                <div id="issuebook" class="container-fluid w-100 portion" style="display:none">
                    <div class="w-100 py-1">
                        <h3 class="w-100 text-center rounded py-3 blur" style="background-color: rgba(0, 53, 102, 0.5);">ISSUE BOOK</h3>
                        <form class="row" action="issuebook_server.php" method="post" enctype="multipart/form-data">
                            <div class="form-group my-1 col-md-6">
                                <label for="book">Choose Book</label>
                                <select class="form-control form-select" aria-label="Select Book" name="book">
                                    <?php
                                    $u = new data;
                                    $u->setconnection();
                                    $u->getbookissue();
                                    $recordset = $u->getbookissue();
                                    foreach ($recordset as $row) {
                                        echo "<option value='" . $row[2] . "'>" . $row[2] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group my-1 col-md-6">
                                <label for="userselect">Select Student:</label>
                                <select class="form-control form-select" aria-label="Select Student" name="userselect">
                                    <?php
                                    $u = new data;
                                    $u->setconnection();
                                    $u->userdata();
                                    $recordset = $u->userdata();
                                    foreach ($recordset as $row) {
                                        $id = $row[0];
                                        echo "<option value='" . $row[1] . "'>" . $row[1] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group my-1 col-md-6">
                                <label for="date">Issue Days</label>
                                <input type="number" class="form-control" name="days" id="date" value="1" required>
                            </div>
                            <br>
                            <!-- Days<input type="number" name="days" /> -->
                            <div class="form-group my-1 mt-auto pl-3">
                                <input class="btn btn-success w-auto mt-3" type="submit" value="SUBMIT" />
                            </div>
                        </form>
                    </div>
                </div>
                <!-- == Issue Book End == -->

                <!-- == Book Detail Start == -->
                <div id="bookdetail" class="container-fluid w-100 portion" style="display:none">
                    <div class="w-100 pY-1">
                        <h3 class="w-100 text-center rounded py-3 blur" style="background-color: rgba(0, 53, 102, 0.5);">BOOK DETAIL</h3>
                        </br>
                        <?php
                        $u = new data;
                        $u->setconnection();
                        $u->getbookdetail($viewid);
                        $recordset = $u->getbookdetail($viewid);
                        foreach ($recordset as $row) {
                            $bookid = $row[0];
                            $bookimg = $row[1];
                            $bookname = $row[2];
                            $bookdetail = $row[3];
                            $bookauthour = $row[4];
                            $bookpub = $row[5];
                            $branch = $row[6];
                            $bookprice = $row[7];
                            $bookquantity = $row[8];
                            $bookava = $row[9];
                            $bookrent = $row[10];
                        }
                        ?>
                        <img width='150px' height='150px' style='border:1px solid #333333; float:left;margin-left:20px' src="uploads/<?php echo $bookimg ?> " />
                        </br>
                        <p style="color:black"><u>Book Name:</u> &nbsp&nbsp<?php echo $bookname ?></p>
                        <p style="color:black"><u>Book Detail:</u> &nbsp&nbsp<?php echo $bookdetail ?></p>
                        <p style="color:black"><u>Book Authour:</u> &nbsp&nbsp<?php echo $bookauthour ?></p>
                        <p style="color:black"><u>Book Publisher:</u> &nbsp&nbsp<?php echo $bookpub ?></p>
                        <p style="color:black"><u>Book Branch:</u> &nbsp&nbsp<?php echo $branch ?></p>
                        <p style="color:black"><u>Book Price:</u> &nbsp&nbsp<?php echo $bookprice ?></p>
                        <p style="color:black"><u>Book Available:</u> &nbsp&nbsp<?php echo $bookava ?></p>
                        <p style="color:black"><u>Book Rent:</u> &nbsp&nbsp<?php echo $bookrent ?></p>
                    </div>
                </div>
                <!-- == Book Detail End == -->

                <!-- == Book Report Start == -->
                <div id="bookreport" class="container-fluid w-100 portion" style="display:none">
                    <div class="w-100 py-1">
                        <h3 class="w-100 text-center rounded py-3 blur" style="background-color: rgba(0, 53, 102, 0.5);">BOOK REPORT</h3>
                        <?php
                        $u = new data;
                        $u->setconnection();
                        $u->getbook();
                        $recordset = $u->getbook();
                        $table = "<table class='table text-white'>
                                <thead class='thead-dark'>
                                <tr>
                                    <th scope='col'>Book Name</th>
                                    <th scope='col'>Price</th>
                                    <th scope='col'>Qnt</th>
                                    <th scope='col'>Available</th>
                                    <th scope='col'>Rent</th>
                                    </tr>
                                    </thead><tbody>";
                        foreach ($recordset as $row) {
                            $table .= "<tr>";
                            "<td>$row[0]</td>";
                            $table .= "<td scope='col'>$row[2]</td>";
                            $table .= "<td scope='col'>$row[7]</td>";
                            $table .= "<td scope='col'>$row[8]</td>";
                            $table .= "<td scope='col'>$row[9]</td>";
                            $table .= "<td scope='col'>$row[10]</td>";
                            // $table.="<td><a href='deletebook_dashboard.php?deletebookid=$row[0]'>Delete</a></td>";
                            $table .= "</tr>";
                            // $table.=$row[0];
                        }
                        $table .= "</tbody></table>";
                        echo $table;
                        ?>
                    </div>
                </div>
                <!-- == Book Report End == -->
            </div>

        </div>

    </main>

    <script>
        function openpart(portion) {
            var i;
            var x = document.getElementsByClassName("portion");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            document.getElementById(portion).style.display = "block";
        }
    </script>
</body>

</html>