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
                            <th>Название</th>
                            <th>Организация</th>
                            <th>Тип курса</th>
                            <th>Начало</th>
                            <th>Конец</th>
                            <th>Количество дней</th>
                            <th>Цена</th>
                            <th>Цена(НДС)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($courses as $course) {
                            echo '<tr>';
                            $query="SELECT ORGANIZATION.name FROM organization 
                            INNER JOIN ticket t ON organization.organization_id = t.organization_id
                            INNER JOIN pin p ON t.pin_id = p.pin_id
                            INNER JOIN course c ON p.course_id = c.course_id
                            WHERE c.course_id='$course->course_id'";
                        $link = mysqli_connect("localhost", "root", "root", "courses");
                        $result = mysqli_query($link, $query);
                        while ($row = $result->fetch_assoc()) {
                            $final=$row['name'];
                        } 
                        $query2="SELECT organization.organization_id FROM organization 
                        INNER JOIN ticket t ON organization.organization_id = t.organization_id
                        INNER JOIN pin p ON t.pin_id = p.pin_id
                        INNER JOIN course c ON p.course_id = c.course_id
                        WHERE ORGANIZATION.name='$final'";
                        $result2 = mysqli_query($link, $query2);
                        while ($row2 = $result2->fetch_assoc()) {
                            $final2=$row2['organization_id'];
                        } 
                        $earlier = new DateTime($course->datestart);
                        $later = new DateTime($course->dateend);
                        $nds=($course->price)+(($course->price)/100)*20;
                        $diff = $later->diff($earlier)->format("%a");
                            echo '<td><a href="view-courses.php?id='.$course->course_id.'">'.$course->name.'</a></td>';
                            echo '<td><a href="view-organization.php?id='.$final2.'">'.$final.'</a></td>';
                            echo '<td>'.$course->coursetype.'</td>';
                            echo '<td>'.$course->datestart.'</td>';
                            echo '<td>'.$course->dateend.'</td>';
                            echo '<td>'.$diff.'</td>';
                            echo '<td>'.$course->price.' тг.</td>';
                            echo '<td>'.$nds.' тг.</td>';
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