<?php
require_once 'secure.php';
if (isset($_GET['id'])) {
    $id = Helper::clearInt($_GET['id']);
    $pin = (new TeacherMap())->findViewById($id);
    $header = 'Просмотр преподавателя';
    require_once 'template/header.php';
    ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <section class="content-header">
                    <h1><?=$header;?></h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fafa-dashboard"></i>Главная</a></li>
                        <li><a href="list-special.php">Преподаватель</a></li>
                        <li class="active"><?=$header;?></li>
                    </ol>
                </section>
                <div class="box-body">

                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>Ф.И.О.</th>
                            <td><?=$pin->fio;?></td>
                        </tr>
                        <tr>
                            <th>Дата рождения</th>
                            <td><?=$pin->birthday;?></td>
                        </tr>
                        <tr>
                            <th>Пол</th>
                            <td><?=$pin->name;?></td>
                        </tr>
                        <tr>
                            <th>Образование</th>
                            <td><?=$pin->education;?></td>
                        </tr>
                        <tr>
                            <th>Степень</th>
                            <td><?=$pin->category;?></td>
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