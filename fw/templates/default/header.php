<?php
if (CORE_INIT === null) die();
use \Fw\Core\Page;
?>
<!doctype html>
<html>
<head>
    <?=Page::showString()?>
    <title><?=Page::showProperty('title')?></title>
    <?=Page::showCss()?>
</head>
<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3">
        <h1>Header</h1>
    </header>
    <nav class="py-2 border-bottom">
            <ul class="nav justify-content-center">
                <li class="nav-item"><a href="/index.php" class="nav-link link-dark px-2" aria-current="page">Index</a></li>
                <li class="nav-item"><a href="/form.php" class="nav-link link-dark px-2">Form</a></li>
            </ul>
    </nav>
</div>
<body>
