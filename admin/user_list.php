<?php 
  require_once(dirname(__FILE__).'/../config/config.php');
  require_once(dirname(__FILE__).'/../function.php');

  session_start();

  if(!isset($_SESSION['USER']) || $_SESSION['USER']['auth_type'] != 1){
    header('Location: /admin/login.php');
    exit;
  }

$pdo = connect_db();
 
$sql = "SELECT * FROM user";
$stmt = $pdo->query($sql);
$user_list = $stmt->fetchAll();
?>
<!doctype html>
<html lang="ja">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <!-- Original CSS-->
    <link rel="stylesheet" href="/css/style.css">

    <title>社員一覧｜WoRKS</title>
</head>

<body class="text-center bg-success">
    <div>
        <img class="mb-4" src="/img/logo.svg" alt="WoRKS" width="80" height="80">
    </div>
    <form class="border rounded bg-white form-user-list" action="index.php">
        <h1 class="h3 my-3">社員一覧</h1>
        <select class="form-control rounded-pill mb-3" id="exampleFormControlSelect1">
            <option>2020/11</option>
        </select>

        <table class="table table-bordered">
            <thead>
                <tr class="bg-light">
                    <th scope="col">社員番号</th>
                    <th scope="col">社員名</th>
                    <th scope="col">権限</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user_list as $user): ?>
                <tr>
                    <td scope="row"><?= $user['user_no']?></td>
                    <td><a href="/admin/user_result.php?id=<?= $user['id']?>"><?= $user['name']?></a></td>
                    <td scope="row"><?php if($user['auth_type']== 1) echo '管理者';?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
        -->
</body>

</html>