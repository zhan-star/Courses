<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * 
 *
 * @author Жан
 */
class CourseMap extends BaseMap
{
    public function arrCourses()
    {
        $res = $this->db->query("SELECT course_id AS id, name AS value FROM course");
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    public function arrCoursetypes()
    {
        $res = $this->db->query("SELECT coursetype_id AS id, name AS value FROM coursetypes");
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    public function save(Course $course) {
        if ($course->validate()) {
            if ($course->course_id == 0) {
                return $this->insert($course);
            } else {
                return $this->update($course);
            }
        }
        return false;
    }
    public function findById($id=null){
        if ($id) {
            $res = $this->db->query("SELECT course_id, course.name, c.name as coursetype_id FROM course 
            INNER JOIN coursetypes c ON course.coursetype_id = c.coursetype_id
            where course_id = $id");
            return $res->fetchObject("Course");
        }
        return new Course();
    }
    private function insert(Course $course){
        $name = $this->db->quote($course->name);
        $coursetype_id = $course->coursetype_id;
        if ($this->db->exec("INSERT INTO course(name,coursetype_id) VALUES($name,$coursetype_id)") == 1 ) {
            $course->course_id = $this->db->lastInsertId();
            return true;
        }
        return false;
    }
    private function update(Course $course){
        $name = $this->db->quote($course->name);
        $coursetype = $course->coursetype_id;
        if ( $this->db->exec("UPDATE course SET name = $name, coursetype_id= $coursetype_id WHERE course_id = ".$course->course_id) == 1) {
            return true;
        }
        return false;
    }
    public function findViewById($id=null){
        if ($id) {
            $res = $this->db->query("SELECT course.course_id, course.name, c.name AS coursetype, (SELECT COUNT(*) FROM courses.student_ticket st WHERE st.ticket_id = course.course_id) AS cnts, p.datestart, p.dateend, p.price FROM course
            INNER JOIN pin p ON course.course_id = p.course_id
            INNER JOIN coursetypes c ON course.coursetype_id = c.coursetype_id 
            WHERE course.course_id=$id
            ORDER BY p.course_id");
            return $res->fetch(PDO::FETCH_OBJ);
        }
        return false;
    }
    public function findGroup($id=null){
        if ($id) {
            $res = $this->db->query("SELECT CONCAT(USER.lastname,' ',USER.firstname,' ',USER.patronymic) AS fio FROM user 
            INNER JOIN student s ON user.user_id = s.student_id
            INNER JOIN student_ticket st ON s.student_id = st.student_id
            inner join ticket t ON st.ticket_id = t.ticket_id
            INNER JOIN pin p ON t.pin_id = p.pin_id
            INNER JOIN course c ON p.course_id = c.course_id
            WHERE p.course_id='$id'");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }
        return false;
    }
    
    public function findAll($ofset=0, $limit=30){
        $res = $this->db->query("SELECT course.course_id, course.name, c.name AS coursetype, (SELECT COUNT(*) FROM courses.student_ticket st WHERE st.ticket_id = course.course_id) AS cnts, p.datestart, p.dateend, p.price FROM course
        INNER JOIN pin p ON course.course_id = p.course_id
        INNER JOIN coursetypes c ON course.coursetype_id = c.coursetype_id ". "LIMIT $ofset,$limit");
        return $res->fetchAll(PDO::FETCH_OBJ);
    }
    public function findAllSecondary(){
        $res = $this->db->query("SELECT course.name as names, (SELECT COUNT(*) FROM courses.student_ticket st WHERE st.ticket_id = course.course_id) AS cnts FROM course
        INNER JOIN pin p ON course.course_id = p.course_id
        INNER JOIN coursetypes c ON course.coursetype_id = c.coursetype_id");
        return $res->fetchAll(PDO::FETCH_OBJ);
    }
    public function findCounts(){
        $res = $this->db->query("SELECT COUNT(course.name) as cnt FROM course
        INNER JOIN pin p ON course.course_id = p.course_id
        INNER JOIN coursetypes c ON course.coursetype_id = c.coursetype_id");
        return $res->fetchAll(PDO::FETCH_OBJ); 
    }
    public function findAll2($id=null){
        if ($id) {
        $res = $this->db->query("SELECT COUNT(*) FROM user 
        INNER JOIN student s ON user.user_id = s.student_id
        INNER JOIN student_ticket st ON s.student_id = st.student_id
        inner join ticket t ON st.ticket_id = t.ticket_id
        INNER JOIN pin p ON t.pin_id = p.pin_id
        INNER JOIN course c ON p.course_id = c.course_id
        WHERE p.course_id='$id'");
        return $res->fetch(PDO::FETCH_NUM);
        }
        return false;
    }

    public function count(){
        $res = $this->db->query("SELECT COUNT(*) AS cnt FROM course");
        return $res->fetch(PDO::FETCH_OBJ)->cnt;
    }

    
}