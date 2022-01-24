<?php

class SortById implements SortInterface
{
    public function Sort($tickets)
    {
        usort($tickets, function ($a, $b) {
            return $a->id <=> $b->id;
        });
        return $tickets;
    }
}
