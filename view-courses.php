<?php
require_once 'secure.php';
if (isset($_GET['id'])) {
    $id = Helper::clearInt($_GET['id']);
    $course = (new CourseMap())->findViewById($id);
    $header = 'Просмотр доступных курсов';
    require_once 'template/header.php';
    ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <section class="content-header">
                    <h1><?=$header;?></h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fafa-dashboard"></i>Главная</a></li>
                        <li><a href="list-special.php">Курсы</a></li>
                        <li class="active"><?=$header;?></li>
                    </ol>
                </section>
                <div class="box-body">

                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>Название</th>
                            <td><?=$course->name;?></td>
                        </tr>
                        <tr>
                            <th>Тип курса</th>
                            <td><?=$course->coursetype;?></td>
                        </tr>
                        <tr>
                            <th>Длительность</th>
                            <td><?=$course->days;?> д.</td>
                        </tr>
                        <tr>
                            <th>В данный момент на курсе</th>
                            <td><?=$course->cnts;?> человек(-а)</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
require_once 'template/footer.php';
?>