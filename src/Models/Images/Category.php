<?php


namespace src\Models\Images;


use Spatie\DataTransferObject\FlexibleDataTransferObject;

class Category extends FlexibleDataTransferObject
{
    public int $id;

    public string $name;

}