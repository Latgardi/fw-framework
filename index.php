<?php
use Fw\Core\Application;
include 'fw/init.php';
$app = Application::getInstance();
$app->header();
?>
<pre>
    31.08.2022
    1) создан трейт singleton
    2) создан класс Page
    01.09.2022
    1) создан класс Template
    2) улучшен класс Application, добавлены функции для вывода контента
    02.09.2022
    1) улучшен класс Page
</pre>
<?php $app->footer() ?>

