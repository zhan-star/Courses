<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserMap
 *
 * @author Жан
 */
 class UserMap extends BaseMap{
    const USER = 'user';
    const TEACHER = 'teacher';
    const STUDENT = 'student';
    public function identity($id){
        if ((new TeacherMap())->findById($id)->validate()) {
            return self::TEACHER;
            }
            if ((new StudentMap())->findById($id)->validate()) {
            return self::STUDENT;
            }
            if ($this->findById($id)->validate()) {
            return self::USER;
            }
            return null;
    }
    public function auth($login, $password){
        $login = $this->db->quote($login);
        $res = $this->db->query("SELECT user.user_id,
        CONCAT(user.lastname,' ', user.firstname, ' ',
        user.patronymic) AS fio, ". "user.pass, role.sys_name, role.name
        FROM user "
        . "INNER JOIN role ON
        user.role_id=role.role_id "
        . "WHERE user.login = $login AND
        user.active = 1");
        $user = $res->fetch(PDO::FETCH_OBJ);
        if ($user) {
        if (password_verify($password, $user->pass))
        {
        return $user;
        }
        }
        return null;
    }
    public function findById($id=null){
        if ($id) {
            $res = $this->db->query("SELECT user_id, lastname,
            firstname, patronymic FROM user WHERE user_id = $id");
            $user = $res->fetchObject("User");
                if ($user) {
                    return $user;
                }
            }
            return new User();
    }

    public function save(User $user){
            if ($user->user_id == 0) {
            return $this->insert($user);
            } else {
            return $this->update($user);
            }
        return false;
    }
    private function insert(User $user)
{

$lastname = $this->db->quote($user->lastname);
$firstname = $this->db->quote($user->firstname);
$patronymic = $this->db->quote($user->patronymic);


if ($this->db->exec("INSERT INTO user(lastname, firstname, patronymic) VALUES($lastname, $firstname, $patronymic)") == 1) {
$user->user_id = $this->db->lastInsertId();
return true;
}
return false;
}
    private function update(User $user){
        $lastname = $this->db->quote($user->lastname);
        $firstname = $this->db->quote($user->firstname);
        $patronymic = $this->db->quote($user->patronymic);
        if ( $this->db->exec("UPDATE user SET lastname = $lastname, firstname = $firstname, patronymic = $patronymic WHERE user_id = ".$user->user_id) == 1) {
            return true;
        }
        return false;
        
    }
    private function existsLogin($login){
        $login = $this->db->quote($login);
        $res = $this->db->query("SELECT user_id FROM user WHERE login = $login");
        if ($res->fetchColumn() > 0) {
            return true;
        }
        return false;
    }
    public function findProfileById($id=null){
        if ($id) {
            $res = $this->db->query("SELECT user.user_id,
            CONCAT(user.lastname,' ', user.firstname, ' ',
            user.patronymic) AS fio,"
            . " user.login, user.birthday, gender.name AS
            gender, role.name AS role, user.active FROM user "
            . "INNER JOIN gender ON
            user.gender_id=gender.gender_id INNER JOIN role ON
            user.role_id=role.role_id WHERE user.user_id = $id");
            return $res->fetch(PDO::FETCH_OBJ);
            }
            return false;
    }
}

