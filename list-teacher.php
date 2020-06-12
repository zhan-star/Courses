<?php
require_once 'secure.php';
$size = 5;
if (isset($_GET['page'])) {
    $page = Helper::clearInt($_GET['page']);
} else {
    $page = 1;
}
$teacherMap = new TeacherMap();
$count = $teacherMap->count();
$teachers = $teacherMap->findAll($page*$size-$size, $size);
$header = 'Преподаватели';
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
                <?php
                if ($teachers) {
                    ?>
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Фамилия</th>
                            <th>Имя</th>
                            <th>Отчество</th>
                            <th>Дата рождения</th>
                            <th>Пол</th>
                            <th>Образование</th>
                            <th>Категория</th>
                            <!--<th></th>-->
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($teachers as $teacher) {

                            echo '<tr>';
                            echo '<td>'.$teacher->lastname.'</td>';
                            echo '<td>'.$teacher->firstname.'</td>';
                            echo '<td>'.$teacher->patronymic.'</td>';
                            echo '<td>'.$teacher->birthday.'</td>';
                            echo '<td>'.$teacher->gender.'</td>';
                            echo '<td>'.$teacher->education.'</td>';
                            echo '<td>'.$teacher->category.'</td>';
                            //echo '<td><a href="add-teacher.php?id='.$teacher->ids.'">ред.</a></td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    </table> 
                    <?php
                } 
                else {
                    echo 'Преподаватели не найдены';
                } 
                ?>
            </div>
            <div class="box-body">
                <a class="btn btn-success" href="add-teacher.php">Добавить преподавателя</a>
            </div>
            <div class="box-body"><h5>Всего преподавателей: <?php echo $count; ?> </h5></div>
            <div class="box-body">
                <?php Helper::paginator($count, $page,$size); ?>
            </div>
        </div>
    </div>
</div>
<?php
require_once 'template/footer.php';
?>