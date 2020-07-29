<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $this->title; ?></title>
</head>
<body>
<menu id="menu">
    <a href="/" data-menu="main" data-link="ajax" >На главную страницу</a>
    <a href="/page/about" data-menu="about" data-link="ajax" >О проекте</a>
    <a href="/p/blog" data-menu="blog" data-link="ajax" >Блог</a>
    <a href="/page/simpple" data-menu="simpple" data-link="ajax" >Проект Simpple</a>
    <a href="/page/contacts" data-menu="contacts" data-link="ajax" >Контакты</a>
</menu>
<div id="app">
	<div id="response"></div>
    <form action="javascript:void(null)" data-url="/test" data-response-dom="#response" method="post">
        <input type="text" name="name" placeholder="Name">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Pass">
        <button type="submit"> Submit </button>
    </form>
    <div id="content">
        <?php echo $this->content; ?>

    </div>


    <?php $this->partial(__DIR__ . '/sidebar.php'); ?>

</div>
<?php echo $this->includes; ?>
</body>
</html>