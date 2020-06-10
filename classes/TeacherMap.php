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
class TeacherMap extends BaseMap{
    public function arrTeachers()
    {
        $res = $this->db->query("SELECT teacher_secondary as id, CONCAT(u.lastname,' ',u.firstname) AS value FROM teacher 
        INNER JOIN user u ON teacher.teacher_id = u.user_id");
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findViewById($id=null){
        if ($id) {
            $res = $this->db->query("SELECT CONCAT(u.lastname,' ',u.firstname,' ',u.patronymic) AS fio, teacher.birthday, g.name, teacher.education, teacher.category FROM teacher
            INNER JOIN user u ON teacher.teacher_id = u.user_id
            INNER JOIN genders g ON teacher.gender = g.gender_id " . " WHERE teacher.teacher_secondary = $id");
            return $res->fetch(PDO::FETCH_OBJ);
        }
        return false;        

    }
    
    public function save(User $user, Teacher $teacher){
        if ($user->validate() && $teacher->validate() && (new UserMap())->save($user)) {
            if ($teacher->user_id == 0) {
                $teacher->user_id = $user->user_id;
                return $this->insert($teacher);
            } 
            else {
                return $this->update($teacher);
            }
        }
        return false;
    }
    private function insert(Teacher $teacher){
        if ($this->db->exec("INSERT INTO teacher(user_id,otdel_id) VALUES($teacher->user_id, $teacher->otdel_id)")== 1) {
            return true;
        }
        return false;
    }
    private function update(Teacher $teacher){
        if ($this->db->exec("UPDATE teacher SET otdel_id = $teacher->otdel_id WHERE user_id=".$teacher->user_id) ==1) {
            return true;
        }
        return false;
    }
    public function findAll($ofset=0, $limit=30){
        $res = $this->db->query("SELECT user.user_id,
        CONCAT(user.lastname,' ', user.firstname, ' ',
        user.patronymic) AS fio, user.birthday, ". " gender.name AS gender, otdel.name AS otdel,
        role.name AS role FROM user INNER JOIN teacher ON
        user.user_id=teacher.user_id ". "INNER JOIN gender ON
        user.gender_id=gender.gender_id INNER JOIN otdel ON
        teacher.otdel_id=otdel.otdel_id". " INNER JOIN role ON user.role_id=role.role_id LIMIT
        $ofset, $limit");
        return $res->fetchAll(PDO::FETCH_OBJ);
    }
    public function count(){
        $res = $this->db->query("SELECT COUNT(*) AS cnt FROM teacher");
        return $res->fetch(PDO::FETCH_OBJ)->cnt;
    }
    public function findProfileById($id=null){
        if ($id) {
            $res = $this->db->query("SELECT teacher.user_id,
            otdel.name AS otdel FROM teacher "
            . "INNER JOIN otdel ON
            teacher.otdel_id=otdel.otdel_id WHERE teacher.user_id =
            $id");
            return $res->fetch(PDO::FETCH_OBJ);
            }
            return false;
    }
}

