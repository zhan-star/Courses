<?php
require_once 'secure.php';
$size = 5;
if (isset($_GET['page'])) {
    $page = Helper::clearInt($_GET['page']);
} else {
    $page = 1;
}
$courseMap = new CourseMap();
$count = $courseMap->count();
$courses = $courseMap->findAll($page*$size-$size, $size);
$header = 'Прайс-лист';
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
            <!--<div class="box-body">
                <a class="btn btn-success" href="add-otdel.php">Добавить отделение</a>
            </div>-->
            <div class="box-body">
                <?php
                if ($courses) {
                    ?>
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Номер курса</th>
                            <th>Название</th>
                            <th>Тип курса</th>
                            <th>Человек в группе</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($courses as $course) {
                            echo '<tr>';
                            echo '<td><a href="view-otdel.php?id='.$pin->pin_id.'">'.$course->course_id.'</a> '. '<a href="add-otdel.php?id='.$otdel->otdel_id.'"><i class="fa fa-pencil"></i></a></td>';
                            echo '<td><a href="view-otdel.php?id='.$pin->pin_id.'">'.$course->name.'</a></td>';
                            echo '<td><a href="view-otdel.php?id='.$pin->pin_id.'">'.$course->coursetype.'</a></td>';
                            echo '<td>'.$course->counts.'/30</td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    </table> 
                    <?php
                } 
                else {
                    echo 'Курсы не найдены';
                } 
                ?>
            </div>
            <div class="box-body">
                <?php Helper::paginator($count, $page,$size); ?>
            </div>
        </div>
    </div>
</div>
<?php
require_once 'template/footer.php';
?>