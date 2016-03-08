<?php
namespace App\Achiive\Transformers;

abstract class Transformer
{

    /**
     * Transform a collection of a response.
     *
     * @param   array  $items  Response from database
     * @return  array
     */
    public function transformCollection(array $items)
    {
        return array_map([$this, 'transform'], $items);
    }

    /**
     * Transform an item of a response.
     *
     * @param   array   $item  Response from database
     * @return  array
     */
    public abstract function transform(array $item);

}
