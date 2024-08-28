## C. View



```php
namespace spl2024\views {

class View
{
    protected $params = []; 
    static $VIEW_DIR = "src/views/";

    static function setViewDir($dir)
    {
        self::$VIEW_DIR = $dir;
    }
    
    function render($tpl, $params=[])
    {
        ob_start();
        extract($params);
        include(self::$VIEW_DIR . 'pg_header.php');
        include(self::$VIEW_DIR . $tpl. '.php');
        include(self::$VIEW_DIR . 'pg_footer.php'); 
        ob_end_flush();
    }

    function redirect($url)
    {
        header("Location:{$url}");
    }
}
    
/*
class User extends View
{

}

class Program extends View
{

}
*/
    
}// End of namespace spl2024\views

```



**viewsフォルダ**に以下のファイルが含まれる(**`src/views/`**に同じファイルが入っている)

- `pg_header.php`
- `pg_footer.php`
- `prg_list.php`
- `usr_list.php`
- `usr_login.php`

## `pg_header.php`

```php
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

```



## `pg_footer.php`

```php
</div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>
    
```



## `prg_list.php`

```php
<h3 class="text-primary">総合教育プログラム登録について</h3>
　情報科学科では、情報技術コースの中に「総合教育プログラム」と「応用教育プログラム」を設けています。「総合教育プログラム」では、情報科学・情報技術の基礎をしっかりと身につけ、ソフトウェア開発やハードウェア開発、情報システムの設計・開発等にかかわる様々な分野で活躍できる技術者を育成します。情報技術コースの履修者は一定の条件を満たしていれば「総合教育プログラム」へ登録することができる。

<div class="bg-info">（登録要件）</div>
　総合教育プログラムに登録するには、１年次終了までに、次の各号に掲げる要件を満たさなければならない。

<ul>
<li>情報技術コースに所属していること。</li>
<li>1年次に配当されている授業科目を38単位以上修得していること。</li>
<li>GPAが2.0以上であること。</li>
</ul>
```

## `usr_list.php`

```php
<?php
echo '<h2 class="text-primary">アカウント一覧</h2>';

$fields = ['uid'=>'ユーザID', 'uname'=>'ユーザ名', 'urole'=>'種別'];
$th_fileds = array_map(fn($item) =>'<th>'.$item.'</th>', array_values($fields));

echo '<table class="table table-hover">', PHP_EOL;
echo '<tr>', implode('', $th_fileds), '</tr>', PHP_EOL; 
foreach ($users as $user) {
    $td_fileds = array_map(fn($field) =>'<td>'.$user[$field].'</td>', array_keys($fields));
    echo "<tr>", implode('', $td_fileds), "</tr>", PHP_EOL;
}
echo '</table>';
```

## `usr_login.php`

```php
<h3 class="text-primary">ログイン</h3>
<form action="?to=usr&do=auth" method="post">
<div class="form-group">
  <label for="text1">ユーザID:</label>
  <input type="text" name="uid" id="text1" class="form-control">
</div>
<div class="form-group">
  <label for="passwd1">パスワード:</label>
  <input type="password" name="upass" id="passwd1" class="form-control">
</div>
<input type="submit" value="送信"><input type="reset" value="取消">
</form>
```

