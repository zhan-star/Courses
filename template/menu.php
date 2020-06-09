<!-- Sidebar Menu -->
<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li
                <?= ($_SERVER['PHP_SELF'] == '/index.php') ? 'class="active"' : ''; ?>>

                <a href="index.php"><i class="fa fa-calendar"></i><span>Главная</span></a>

            </li>
            <li class="header">Пользователи</li>

            <li <?= ($_SERVER['PHP_SELF'] == '/list-teacher.php') ? 'class="active"' : ''; ?>>
                <a href="list-teacher.php"><i class="fa fa-users"></i><span>Преподаватели</span></a>
            </li>
            <li <?= ($_SERVER['PHP_SELF'] == '/list-student.php') ? 'class="active"' : ''; ?>> 
                <a href="list-student.php"><i class="fa fa-users"></i><span>Студенты</span></a>
            </li>
            <li class="header">Основное</li>
            <li <?=($_SERVER['PHP_SELF']=='/list-course.php')?'class="active"':'';?>>
                <a href="list-course.php"><i class="fa fa-users"></i><span>Прайс-лист</span></a>
            </li>
            <li <?=($_SERVER['PHP_SELF']=='/list-pin.php')?'class="active"':'';?>>
                <a href="list-pin.php"><i class="fa fa-users"></i><span>Расписание</span></a>
            </li>
            <li <?=($_SERVER['PHP_SELF']=='/list-filling.php')?'class="active"':'';?>>
                <a href="list-filling.php"><i class="fa fa-users"></i><span>Наполнение групп</span></a>
            </li>
            </li>
        </ul>
    </section>
</aside>
<!-- /.sidebar-menu -->