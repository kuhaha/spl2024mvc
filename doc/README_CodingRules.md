# コーディング規約

- **命名規則**：変数名、定数名、メソッド名、クラス名、フォルダ名、ファイル名に関する規則
- **改行やスペースに関する規則**：スペース、改行に関する規則
- **オートロードに関する規則**：クラス等の自動読み込みに関する規則

#### PSR-1

- PHPコードは「`<?php`」及び 「`<?=`」タグを使用する。
- 文字コードは`UTF-8`（BOM無し）を使用する。
- シンボル（クラス、関数、定数など）を**宣言する**ためのファイルと、**副作用のある**処理（出力の生成、`ini`設定の変更など）を行うためのファイルは、分けるべき。
- **名前空間**、**クラス**については`PSR-0`に準拠しなければならない。
- **クラス名**は、`StudlyCaps`（単語の先頭文字を大文字で表記する記法）記法で定義する。
- **クラス定数**は全て大文字とし、区切り文字にはアンダースコアを用いて定義する。例：`MAX_ROWS`
- **変数名**は、`lowerCamelCase`記法（小文字で始め以降も小文字。単語の区切りは大文字にする）を使うこと。
- **メソッド名**は`lowerCamelCase`記法で定義する。

#### PSR-2

- `namespace`、`use`、`class`の間には空白行を入れる
- インデントは、タブではなく、半角スペース4つとする
- 行の長さは１２０文字を上限とし、８０文字以内に抑えるべき
- クラス、メソッドの開き括弧`{`は次の行に記述しなければならない
- 制御構造(`if`や`while`等)の開き括弧`{`は同じ行に記述し、閉じ括弧`}`は新しい行に記述しなければならない
- PHPコードしかないファイルに、閉じタグ`?>`が不要
- ファイルの最後に空行を入れる

#### PSR-4

- ファイルパスからクラスをオートロードするための仕様を定めている。
- **完全修飾クラス名**は以下の形式を持つ。<br>
`\<NamespaceName>(\<SubNamespaceNames>)*\<ClassName>`
- 完全修飾クラス名は トップレベルの名前空間名（ベンダー名前空間とも呼ばれる）を持たなければならない。


### ソースコード例　

**(副作用のない場合)**
```php
<?php
namespace Vendor\Package;

use FooInterface;
use BarClass as Bar;
use OtherVendor\OtherPackage\BazClass;

class Foo extends Bar implements FooInterface
{
    public function sampleFunction($arg1, $arg2 = null)
    {
        if ($arg1 === $arg2) {
            $this->foo($arg1);
        } elseif ($arg1 > $arg2) {
            self::bar($arg1, $arg2);
        } else {
            BazClass::hoge($arg2, $arg3);
        }
    }

    public function foo($a)
    {
        // メソッド本文     
    }

    public static function bar($a, $b)
    {
        // メソッド本文
    }
}

```
**( 副作用のある場合)**
```php
<?php
namespace wp2024mvc\views;

use wp2024mvc\models\User;

$appName = "履修登録システム";
$action = "register";

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?=$appName?>-<?=$action?></title>
</head>
<body>
<ul>
<?php
$id = $_SESSION['user_id'];
$usr = (new User())->getDetail($id);
foreach ($user as $key=>$value){
    printf('<li>%s: %s</li>' . PHP_EOL, $key, $value); 
}

?>
</ul>
</body>
</html>
```
# 開発環境

## 設定ファイル

- `XAMPP_ROOT\php\php.ini`
- `XAMPP_ROOT\apache\conf\httpd.conf`
- `APP_DIR\.htaccess`

## エラーログ

- `XAMPP_ROOT\apache\logs\access_log`
- `XAMPP_ROOT\apache\logs\error_log`
