<?php
require_once 'filter.php';
class CustomerFilter extends Filter
{
    public $user;
    public function __construct($user)
    {
        $this->user = $user;
    }
    public function generate()
    {

        return
            "SELECT * FROM ticket WHERE ticket.author_id={$this->user->id}";
    }
}
