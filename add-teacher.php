<?php
require_once 'secure.php';
$id = 0;
if (isset($_GET['id'])) {
    $id = Helper::clearInt($_GET['id']);
}
$teacher = (new TeacherMap())->findById($id);
$header = (($id) ? 'Редактировать данные' : 'Добавить') . ' преподавателя';
require_once 'template/header.php';
?>
    <section class="content-header">
        <h1><?= $header; ?></h1>
        <ol class="breadcrumb">

            <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>

            <li><a href="list-teacher.php">Преподаватели</a></li>

            <li class="active"><?= $header; ?></li>
        </ol>
    </section>
    <div class="box-body">
        <form action="save-user.php" method="POST">
            <?php require_once '_formUser.php'; ?>
            <div class="form-group">
                <label>Дата рождения</label>
                <input type="date" class="form-control" name="birthday" required="required" value="<?=$teacher->birthday;?>">
            </div>
            <div class="form-group">
                <label>Пол</label>
                <select class="form-control" name="gender">
                    <?= Helper::printSelectOptions($teacher->gender, (new DolzhnostMap())->arrGenders()); ?>
                </select>
            </div>
            <div class="form-group">
                <label>Образование</label>
                <input type="text" class="form-control" name="education" required="required" value="<?=$teacher->education;?>">
            </div>
            <div class="form-group">
                <label>Категория</label>
                <input type="text" class="form-control" name="category" required="required" value="<?=$teacher->category;?>">
            </div>
            <div class="form-group">
                <button type="submit" name="saveTeacher" class="btn btn-primary">Сохранить</button>
            </div>
        </form>
    </div>
<?php
require_once 'template/footer.php';
?>