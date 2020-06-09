<?php
require_once 'secure.php';
if (isset($_GET['id'])) {
    $id = Helper::clearInt($_GET['id']);
    $organization = (new OrganizationMap())->findViewById($id);
    $header = 'Просмотр организации';
    require_once 'template/header.php';
    ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <section class="content-header">
                    <h1><?=$header;?></h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fafa-dashboard"></i>Главная</a></li>
                        <li><a href="list-special.php">Организация</a></li>
                        <li class="active"><?=$header;?></li>
                    </ol>
                </section>
                <div class="box-body">

                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>Наименование</th>
                            <td><?=$organization->name;?></td>
                        </tr>
                        <tr>
                            <th>Адрес</th>
                            <td><?=$organization->address;?></td>
                        </tr>
                        <tr>
                            <th>Телефон</th>
                            <td><?=$organization->phone;?></td>
                        </tr>
                        <tr>
                            <th>Эл.почта</th>
                            <td><?=$organization->email;?> </td>
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