<?php
    require_once 'secure.php';
    $id = 0;
    if (isset($_GET['id'])) {
        $id = Helper::clearInt($_GET['id']);
    }
    $organization = (new OrganizationMap())->findById($id);
    $header = (($id)?'Редактировать':'Добавить').' организацию';
    require_once 'template/header.php';
?>
<section class="content-header">
    <h1><?=$header;?></h1>
    <ol class="breadcrumb">
        <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="list-organizations.php">Организации</a></li>
        <li class="active"><?=$header;?></li>
    </ol>
</section>
<div class="box-body">
    <form action="save-organization.php" method="POST">
        <div class="form-group">
            <label>Наименование</label>
            <input type="text" class="form-control"name="name" required="required" value="<?=$organization->name;?>">
        </div>
        <div class="form-group">
            <label>Адрес организации</label>
            <input type="text" class="form-control" name="address" required="required" value="<?=$organization->address;?>">
        </div>
        <div class="form-group">
            <label>Контактный номер</label>
            <input type="text" class="form-control"name="phone" required="required" value="<?=$organization->phone;?>">
        </div>
        <div class="form-group">
            <label>Эл.почта</label>
            <input type="text" class="form-control"name="email" required="required" value="<?=$organization->email;?>">
        </div>
        <div class="form-group">
            <button type="submit" name="saveOrganization" class="btn btn-primary">Сохранить</button>
        </div>
        <input type="hidden" name="organization_id"value="<?=$id;?>"/>
    </form>
</div>
<?php
    require_once 'template/footer.php';
?>