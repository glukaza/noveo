<?php

namespace Shop\Model;

class Product
{
    public $id;

    public $name;

    public $description;

    public $price;

    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->price = $data['price'];
    }
}