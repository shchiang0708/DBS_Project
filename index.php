<!DOCTYPE html>
<?php
    setcookie('mID', '');
?>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style media="screen">
    .login-container {
        margin-top: 5%;
        margin-bottom: 5%;
    }

    .login-form-1 {
        padding: 10%;
        background: #fff;
        box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
    }

    .login-form-1 h2 {
        text-align: center;
        color: #333;
        font-size: 48px;
        margin-top: -7%;
    }

    .login-form-2 {
        padding: 5%;
        background: #0062cc;
        box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
    }

    .login-form-2 h2 {
        text-align: center;
        color: #fff;
        font-size: 48px;
    }

    .login-container form {
        padding: 10%;
    }

    .btnSubmit {
        width: 50%;
        border-radius: 1rem;
        padding: 1.5%;
        border: none;
        cursor: pointer;
    }

    .login-form-1 .btnSubmit {
        font-weight: 600;
        color: #fff;
        background-color: #0062cc;

    }

    .login-form-2 .btnSubmit {
        font-weight: 600;
        color: #0062cc;
        background-color: #fff;
    }

    input {
        font-size: 16px;
    }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="jumbotron text-center">
            <h1>實驗室書籍管理系統</h1>
        </div>
    </div>

    <div class="container login-container">
        <div class="row">
            <div class="col-sm-6 login-form-1">
                <!--
            TODO: (1) When user login successfully, Show the book_info that the member has borrowed.
                  (2) Then ask for borrowing more books or returning books.
                  (3) If the member choose to borrow books, then switch the page to search books.
                      After searching, he/she can click button '借閱' to borrow the corresponded books.
                      (i) If the book has been borrowed, then send email to the member who borrowed that books.
                      (i) If the book was borrowed by yourselves, then show message that you have borrow the books.
                  (4) If the member had borrowed some books before, he/she can return the book by click
                      the '歸還' button directly.
          -->
                <h2>Member</h2>
                <form action="./Member/ShowBorrow.php" method="post">
                    <div class="form-group">
                        <input type="text" style="font-size: 16px;" class="form-control" name="mID" placeholder="請輸入學號"
                            value="" />
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btnSubmit" value="Login" />
                    </div>
                </form>
            </div>
            <div class="col-sm-6 login-form-2">
                <!--
            TODO: (1) When staff login successfully, goto the EnterBooks.phps
                  (2) Insert books info with "NO BLANK COLUMN", if the book does not exist in database
                      Then the book can be inserted and send email to all member
                  (3) Delete books, too
          -->
                <h2>Staff</h2>
                <form action="./Staff/ShowAllBooks.php" method="post">
                    <div class="form-group">
                        <input type="text" style="font-size: 16px;" class="form-control" name="aName"
                            placeholder="Account" value="" />
                    </div>
                    <div class="form-group">
                        <input type="password" style="font-size: 16px;" class="form-control" name="pwd"
                            placeholder="Password" value="" />
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btnSubmit" value="Login" />
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>