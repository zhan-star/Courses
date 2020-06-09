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
class PinMap extends BaseMap
{
    public function arrPins()
    {
        $res = $this->db->query("SELECT pin_id AS id, course_id AS value FROM otdel");
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    public function save(Pin $pin) {
        if ($pin->validate()) {
            if ($pin->pin_id == 0) {
                return $this->insert($pin);
            } else {
                return $this->update($pin);
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
            $res = $this->db->query("SELECT CONCAT(u.lastname,' ',u.firstname,' ',u.patronymic) AS fio, teacher.birthday, g.name, teacher.education, teacher.category FROM teacher
            INNER JOIN user u ON teacher.teacher_id = u.user_id
            INNER JOIN genders g ON teacher.gender = g.gender_id " . " WHERE teacher.teacher_secondary = $id");
            return $res->fetch(PDO::FETCH_OBJ);
        }
        return false;
    }
    public function setTeacherId(){ 
            $res = $this->db->query("SELECT teacher.teacher_secondary from teacher
            INNER JOIN user u ON teacher.teacher_id = u.user_id
            WHERE CONCAT(u.lastname,' ',u.firstname,' ',u.patronymic)='Боднарь Дмитрий Максимович' ");
            //return $res->fetchAll(PDO::FETCH_NUM); 
            $query="SELECT teacher.teacher_secondary from teacher
            INNER JOIN user u ON teacher.teacher_id = u.user_id
            WHERE CONCAT(u.lastname,' ',u.firstname,' ',u.patronymic)='Боднарь Дмитрий Максимович' ";
            $link = mysqli_connect("127.0.0.1", "root", "root", "courses");
            $result = mysqli_query($link, $query);
            return $result;  
    }
    public function findAll($ofset=0, $limit=30){
        $res = $this->db->query("SELECT pin.pin_id, CONCAT(u.lastname,' ', u.firstname,' ', u.patronymic) AS fio, c.`name`, pin.datestart, pin.dateend, pin.price FROM pin
        INNER JOIN teacher t ON pin.teacher_id = t.teacher_id
        INNER JOIN user u ON t.teacher_id = u.user_id
        INNER JOIN course c ON pin.course_id = c.course_id 
        ORDER BY pin.pin_id ". "LIMIT $ofset,$limit");
        return $res->fetchAll(PDO::FETCH_OBJ);
    }

    public function count(){
        $res = $this->db->query("SELECT COUNT(*) AS cnt FROM pin");
        return $res->fetch(PDO::FETCH_OBJ)->cnt;
    }

    
}