<?php
require_once 'filter.php';
class DepartmentHeadFilter extends Filter
{
    public $user;
    public function __construct()
    {
    }
    public function generate()
    {

         return
         "SELECT * FROM ticket WHERE ticket.author_id={$this->user->id}";

    }
}
