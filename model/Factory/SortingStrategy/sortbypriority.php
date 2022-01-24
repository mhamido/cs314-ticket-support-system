<?php

class SortByPriority implements SortInterface
{
    public function Sort($tickets)
    {
        usort($tickets, function ($a, $b) {
            return $a->priority <=> $b->priority;
        });
        return $tickets;
    }
}
