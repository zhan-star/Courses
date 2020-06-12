<?php
require_once 'secure.php';
if (isset($_GET['id'])) {
    $id = Helper::clearInt($_GET['id']);
    $course = (new CourseMap())->findViewById($id);
    $courseMap = new CourseMap();
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
                    <?php 
                        $earlier = new DateTime($course->datestart);
                        $later = new DateTime($course->dateend);
                        $diff = $later->diff($earlier)->format("%a");
                    ?>
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
                            <td><?=$diff;?> д.</td>
                        </tr>
                        <tr>
                            <th>В данный момент на курсе</th>
                            <td><?php echo '<a href="view-group.php?id='.$course->course_id.'">'.$courseMap->findAll2($course->course_id)[0].' человек(-а)</a></td>';?>
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