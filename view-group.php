<?php
require_once 'secure.php';
$size = 5;
if (isset($_GET['page'])) {
    $page = Helper::clearInt($_GET['page']);
} else {
    $page = 1;
}
if(isset($_GET['id'])){
$id = Helper::clearInt($_GET['id']);
}
$courseMap = new CourseMap();
$count = $courseMap->count();
$courses = $courseMap->findGroup($id);
$header = 'Статус заполненности групп';
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
                            <th>Ф.И.О.</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($courses as $course) {
                            echo '<tr>';
                            echo '<td>'.$course->fio.'</td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    </table> 
                    <?php
                } 
                else {
                    echo 'В этой группе еще нет студентов';
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