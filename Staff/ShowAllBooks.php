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
    table {
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
            <h2>Admin</h2>
        </div>
    </div>
    <?php
        include '../Connection.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $aName = $_POST['aName'];
            $pwd = $_POST['pwd'];

            $sql = "SELECT * FROM admin WHERE aName = '$aName' AND pwd = '$pwd';";
            $result = mysqli_query($db, $sql);
            if (mysqli_num_rows($result) == 0) {
                echo "<script>";
                echo "alert('帳號 or 密碼輸入錯誤');";
                echo "location.href = '../index.php';";
                echo "</script>";
            }
        }
    ?>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-10">
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="./ShowAllBooks.php">Home</a></li>
                        <li><a href="./EnterBooks.php">新增書籍</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href=''>Admin 您好</a></li>
                        <li><a href='../index.php'>Logout</a></li>
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
            $sql = "SELECT * FROM book_info";
            $result = mysqli_query($db, $sql);
        ?>
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
                    <th scode="col">Borrowed_ID</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $count = 1;
                    while ($book_to_show = $result->fetch_row()) {
                        // echo "<tbody>";
                        echo "<tr>";
                        echo "<td>" . $count . "</td>";
                        echo "<td>" . $book_to_show[0] . "</td>";
                        echo "<td>" . $book_to_show[1] . "</td>";
                        echo "<td>" . $book_to_show[2] . "</td>";
                        echo "<td>" . $book_to_show[3] . "</td>";
                        echo "<td>" . $book_to_show[4] . "</td>";
                        echo "<td>" . $book_to_show[5] . "</td>";
                        // echo "<td>" . $book_to_show[6] . "</td>";
                        $count++;
                        // echo "</tbody>";
                    }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>