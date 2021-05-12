<!DOCTYPE html>
<html lang="en">

<head>
    <title>實驗室書籍管理系統</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style media="screen">
    div.container table {
        font-size: 20px;
    }

    nav {
        font-size: 20px;
        font-weight: bold;
    }

    .thead-inverse th {
        color: #fff;
        background-color: #373a3c;
    }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="jumbotron text-center">
            <h1>實驗室書籍管理系統</h1>
            <h2>Member</h2>
        </div>
    </div>
    <?php
        include '../Connection.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $mID = $_POST['mID'];
            $sql = "SELECT * FROM Member WHERE mID = '$mID';";
            $result = mysqli_query($db, $sql);
            if (mysqli_num_rows($result) == 0) {
                echo "<script>";
                echo "alert('學號輸入錯誤');";
                echo "location.href = '../index.php';";
                echo "</script>";
                exit();
            } else {
                setcookie('mID', $mID);
            }
        } else {
            $mID = $_COOKIE['mID'];
        }
    ?>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-10">
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="./ShowBorrow.php">Home</a></li>
                        <li><a href="./SearchBooks.php">書籍查詢</a></li>
                        <li><a href="./SearchBooksByCategory.php">種類</a></li>
                        <li><a href="./SearchBooksByPublication.php">出版商</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                            echo "<li><a class='nav-link disabled' aria-disabled='true'>$mID 您好</a></li>";
                            echo "<li><a href='../index.php'>Logout</a></li>";
                        ?>
                        <!-- <li class="active"><a href="./">Default <span class="sr-only">(current)</span></a></li>
              <li><a href="../navbar-static-top/">Static top</a></li>
              <li><a href="../navbar-fixed-top/">Fixed top</a></li> -->
                    </ul>
                </div>
            </div>
            <div class="col-sm-1">
            </div>
            <!--/.nav-collapse -->
        </div>
        <!--/.container-fluid -->
    </nav>
    <div class="container">
        <?php
            $sql = "SELECT book_info.* FROM Member, book_info WHERE borrowed_id = '$mID' AND mID = '$mID';";
            $result = mysqli_query($db, $sql);
            if (mysqli_num_rows($result) == 0) {
                echo "<div class='row'>";
                echo "<h3 style='text-align: center;'><b>您沒有借任何書!!!</b></h3>";
                echo "</div>";
                exit();
            }
        ?>
        <div class="row">
            <div class="col-sm-1">

            </div>
            <div class="col-sm-10">
                <table class="table table-bordered">
                    <thead class="thead-inverse">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ISBN</th>
                            <th scope="col">Title</th>
                            <th scope="col">Author</th>
                            <!-- <th scope="col">Edition</th> -->
                            <th scope="col">Publication</th>
                            <th scope="col">Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                            while ($book_to_show = $result->fetch_row()) {
                                echo "<tr>";
                                echo "<td>" . $count . "</td>";
                                echo "<td>" . $book_to_show[0] . "</td>";
                                echo "<td>" . $book_to_show[1] . "</td>";
                                echo "<td>" . $book_to_show[2] . "</td>";
                                echo "<td>" . $book_to_show[3] . "</td>";
                                echo "<td>" . $book_to_show[4] . "</td>";
                                // echo "<td>" . $book_to_show[5] . "</td>";
                                $title = urlencode($book_to_show[1]);
                                echo "<td><a class='btn btn-primary' href='ReturnBooks.php?isbn=$book_to_show[0]&title=$title'>歸還</a></td>";
                                echo "</tr>";
                                $count++;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>

</html>
<!-- <!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>實驗室圖書管理系統</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <body>
    <div class="container">
      <h1 style="text-align: center">實驗室圖書管理系統
      <button type="button" style="position: absolute; right: 5%; background-color: Transparent;" onclick="window.location='../index.php'">
        <i class="fa fa-home" style="font-size:48px"></i>
      </button>
      </h1>
    </div>
    <div class="container">

    </div>

  </body>

</html> -->