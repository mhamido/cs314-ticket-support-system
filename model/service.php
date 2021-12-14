<?php
class Service extends ModifiableEntity
{
    public $price;
    public $parent;
    public $description;
    public $attributes;

    public function __construct($id)
    {
        throw new Exception("TODO: Implement Services EAV.");
    }

    /** @deprecated, use `$service->price` instead. */
    public function price()
    {
        return $this->price;
    }

    public function perform()
    {
    }

    /** @deprecated, use `$service->description` instead. */

    public function description()
    {
        return $this->description;
    }

    protected function __update()
    {
    }
}
