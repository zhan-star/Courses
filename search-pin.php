<?php
    require_once 'secure.php';
    $id = 0;
    if (isset($_GET['id'])) {
        $id = Helper::clearInt($_GET['id']);
    }
    $header = ('Поиск по дате');
    require_once 'template/header.php';
?>
<section class="content-header">
    <h1><?=$header;?></h1>
    <ol class="breadcrumb">
        <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="list-pin.php">Заявки</a></li>
        <li class="active"><?=$header;?></li>
    </ol>
</section>
<div class="box-body">
    <form action="list-pin-date.php" method="POST">
        <div class="form-group">
            <label>Введите дату:</label>
            <input type="date" class="form-control" name="value" required="required">
        </div>
        <div class="form-group">
            <button type="submit" name="searchPin" class="btn btn-primary">Искать</button>
        </div>
    </form>
</div>
<?php
    require_once 'template/footer.php';
?>