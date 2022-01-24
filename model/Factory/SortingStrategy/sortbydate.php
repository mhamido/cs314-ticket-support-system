<?php

class SortByDate implements SortInterface
{
    public function Sort($tickets)
    {
        usort($tickets, function ($a, $b) {
            return strcasecmp($a->dateCreated, $b->dateCreated) == 0;
        });
        return $tickets;
    }
}
