<?php
require_once 'secure.php';
if (isset($_POST['course_id'])) {
$course = new Course();
$course->course_id =Helper::clearInt($_POST['course_id']);
$course->name = Helper::clearString($_POST['name']);
$course->coursetype =Helper::clearString($_POST['coursetype']);
if ((new CourseMap())->save($course)) {
header('Location: success.php');
}}