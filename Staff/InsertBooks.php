<!DOCTYPE html>
<html lang="en" dir="ltr">


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
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="jumbotron text-center">
            <h1>實驗室書籍管理系統</h1>
            <h2>Admin</h2>
        </div>
    </div>
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
    <?php
        include "../Connection.php";

        $isbn = $_POST["isbn"];
        $title = $_POST["title"];
        $author = $_POST["author"];
        // $edition = $_POST["edition"];
        $publication = $_POST["publication"];
        $category = $_POST['category'];

        /*
         ********************************************************
        For insertion, No column can be empty
         ********************************************************
         */
        if (empty($isbn) || empty($title) || empty($author) || empty($publication) || empty($category)) {
            echo "<script>";
            echo "alert('欄位不能為空');";
            echo "history.go(-1);";
            echo "</script>";
        } else {
            $sql = "INSERT INTO book_info (isbn, title, author,publication, category)
                                      VALUES('$isbn','$title','$author','$publication', '$category');";
            mysqli_query($db, $sql);
            // echo $result;
            if (mysqli_affected_rows($db) > 0) {
                include "../Sendmail.php";
                $sql = "SELECT email FROM Member;";
                $result = mysqli_query($db, $sql);
                $email = array();
                while ($row = $result->fetch_row()) {
                    array_push($email, $row[0]);
                }
                // print_r($email);
                sendMailForNewBooks($email, $title); //($whoborrow,$book)
                echo "<script>";
                echo "alert('\'$title\' 已成功被新增，並且以email通知所有人');";
                echo "location.href='./ShowAllBooks.php'";
                echo "</script>";
            } else {
                echo "<script>";
                echo "alert('\'$title\' 無法新增');";
                echo "history.go(-1)";
                echo "</script>";
            }
        }
    ?>

</body>

</html>