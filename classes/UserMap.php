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
    private function insert(User $user){
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
}

