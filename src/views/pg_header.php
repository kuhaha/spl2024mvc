<!doctype html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SPL2024</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom border-bottom-dark">
  <div class="container-fluid ">
    <a class="navbar-brand" href="?to=prg&do=list">SPL2024</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <?=$_SESSION['uname'] ?? 'ゲスト'?>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="?to=prg&do=list">HOME</a>
               
        <?php
        if (isset($_SESSION['urole'])){
          echo '<a class="nav-link" href="?to=usr&do=list">LIST</a>', PHP_EOL;
          echo '<a class="nav-link" href="?to=usr&do=logout">LOGOUT</a>', PHP_EOL;
        }else{
          echo '<a class="nav-link" href="?to=usr&do=login">LOGIN</a>', PHP_EOL;
        }
        ?>
      </div>
    </div>
  </div>
</nav>
  <div class="container">
