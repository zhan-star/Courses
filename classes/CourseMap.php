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
        $res = $this->db->query("SELECT pin_id AS id, course_id AS value FROM otdel");
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
            $res = $this->db->query("SELECT pin_id, teacher_id, course_id, datestart, dateend,price " . "FROM pin WHERE pin_id = $id");
            return $res->fetchObject("Pin");
        }
        return new Pin();
    }
    /*private function insert(Pin $pin){
        $name = $this->db->quote($otdel->name);
        $active = $this->db->quote($otdel->active);
        if ($this->db->exec("INSERT INTO otdel(name,active)"
                . " VALUES($name,$active)") == 1 ) {
            $otdel->otdel_id = $this->db->lastInsertId();
            return true;
        }
        return false;
    }
    private function update(Otdel $otdel){
        $name = $this->db->quote($otdel->name);
        if ( $this->db->exec("UPDATE otdel SET name = $name,". " active= $otdel->active WHERE otdel_id = ".$otdel->otdel_id) == 1) {
            return true;
        }
        return false;
    }*/
    public function findViewById($id=null){
        if ($id) {
            $res = $this->db->query("SELECT course.course_id, course.name, course.coursetype, p.datestart, p.dateend, course.days, p.price FROM course
            INNER JOIN pin p ON course.course_id = p.course_id " . " WHERE course.course_id = $id");
            return $res->fetch(PDO::FETCH_OBJ);
        }
        return false;
    }
    public function findAll($ofset=0, $limit=30){
        $res = $this->db->query("SELECT course.course_id, course.name, course.coursetype, (SELECT COUNT(*) FROM courses.student_ticket st WHERE st.ticket_id = course.course_id) AS cnts, p.datestart, p.dateend, course.days, p.price FROM course
        INNER JOIN pin p ON course.course_id = p.course_id
        ORDER BY p.course_id ". "LIMIT $ofset,$limit");
        return $res->fetchAll(PDO::FETCH_OBJ);
    }

    public function count(){
        $res = $this->db->query("SELECT COUNT(*) AS cnt FROM course");
        return $res->fetch(PDO::FETCH_OBJ)->cnt;
    }

    
}