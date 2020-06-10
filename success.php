<?php
require_once 'secure.php';
$header = 'Успешно';
require_once 'template/header.php';
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <section class="content-header">
                <h1><?=$header;?></h1>
                <ol class="breadcrumb">
                    <li><a href="/index.php"><i class="fa fa-dashboard"></i>Главная</a></li>
                    <li class="active"><?=$header;?></li>
                </ol>
            </section>

            <div class="box-body">
               <h5><a href="list-course.php">Вернуться назад...</a></h5>
            </div>
        </div>
    </div>
</div>
<?php
require_once 'template/footer.php';
?>