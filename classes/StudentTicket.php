<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StudentTicket
 *
 * @author Жан
 */

class StudentTicket extends Table
{
    public $student_ticket_id = 0;
    public $student_id = '';
    public $ticket_id = '';
    public function validate()
    {
        if (!empty($this->student_id) && !empty($this->ticket_id)) {
            return true;
        }
        return false;
    }
}