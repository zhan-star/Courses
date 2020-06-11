<?php
require_once 'secure.php';
$size = 5;
if (isset($_GET['page'])) {
    $page = Helper::clearInt($_GET['page']);
} else {
    $page = 1;
}
$organizationMap = new OrganizationMap();
$count = $organizationMap->count();
$organizations = $organizationMap->findAll($page*$size-$size, $size);
$header = 'Организации';
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
                    <a class="btn btn-success" href="add-organization.php">Зарегистрировать организацию</a>
            </div>
            <div class="box-body">
                    <a class="btn btn-success" href="add-ticket.php">Назначить организацию на курс (закрепление)</a>
            </div>
            <div class="box-body">
                <?php
                if ($organizations) {
                    ?>
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Наименование</th>
                            <th>Адрес</th>
                            <th>Телефон</th>
                            <th>Эл.почта</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($organizations as $organization) {
                            echo '<tr>';
                            echo '<td><a href="view-organization.php?id='.$organization->organization_id.'">'.$organization->name.'</a>&nbsp;&nbsp;<a href="add-organization.php?id='.$organization->organization_id.'"><i class="fa fa-pencil"></i></a></td>';
                            echo '<td>'.$organization->address.'</td>';
                            echo '<td>'.$organization->phone.'</td>';
                            echo '<td>'.$organization->email.'</td>';
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