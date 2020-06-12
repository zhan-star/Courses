<?php
require_once 'secure.php';
if (isset($_POST['user_id'])) {
    $user = new User();
    $user->lastname = Helper::clearString($_POST['lastname']);
    $user->user_id = Helper::clearInt($_POST['user_id']);
    $user->firstname = Helper::clearString($_POST['firstname']);
    $user->patronymic = Helper::clearString($_POST['patronymic']);
    if (isset($_POST['saveStudent'])) {
        $student = new Student();
        $student->dolzhnost_id = Helper::clearInt($_POST['dolzhnost_id']);
        if ((new StudentMap())->save($user, $student)) {

            header('Location: success.php');

        } else {
            if ($student->student_id) {

                header('Location: add-student.php?id=' . $student->student_id);

            } else {
                header('Location: add-student.php');
            }
        }
        exit();
    }

    if (isset($_POST['saveTeacher'])) {
        $teacher = new Teacher();
        $teacher->birthday =Helper::clearString($_POST['birthday']);
        $teacher->gender = Helper::clearString($_POST['gender']);
        $teacher->education = Helper::clearString($_POST['education']);
        $teacher->category = Helper::clearString($_POST['category']);
        
        if ((new TeacherMap())->save($user, $teacher)) {
            header('Location: success.php');
        } else {
            if ( $teacher->user_id) {
                header('Location: add-teacher.php?id=' .  $student->student_id);
            } else {
                header('Location: add-teacher.php');
            }
        }
        exit();
    }
}