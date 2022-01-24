<?php
class SortByName implements SortInterface
{
    public function Sort($tickets)
    {

        usort($tickets, function ($a, $b) {
            return strcasecmp($a->title, $b->title);
        });

        return $tickets;
    }
}
