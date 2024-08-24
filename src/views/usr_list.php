<?php
echo '<h2 class="text-primary">アカウント一覧</h2>';

$fields = ['uid'=>'ユーザID', 'uname'=>'ユーザ名', 'urole'=>'種別'];
$t_fileds = array_map(fn($item) =>'<th>'.$item.'</th>', array_values($fields));

echo '<table class="table table-hover">', PHP_EOL;
echo '<tr>', implode('', $t_fileds), '</tr>', PHP_EOL; 
foreach ($users as $user) {
    $t_fileds = array_map(fn($field) =>'<td>'.$user[$field].'</td>', array_keys($fields));
    echo "<tr>", implode('', $t_fileds), "</tr>", PHP_EOL;
}
echo '</table>';
