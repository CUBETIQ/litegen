<?php


namespace App\Base;


interface BaseInterface
{
    public function getModel();

    public function findall($id, $column = "id", $comparator = "=");

    public function findfirst($id, $column = "id", $comparator = "=");

    public function create($data);

    public function update($id, $data, $column = "id", $comparator = "=");
}
