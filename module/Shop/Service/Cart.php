<?php
namespace Shop\Service;


class Cart
{
    public function getCart($storageData)
    {
        $data = [];
        $data['products_count'] = 0;
        $data['total_sum'] = 0;
        foreach($storageData as $id => $item){
            $data['products_count'] = $item->quantity + $data['products_count'];
            $data['total_sum'] = $item->price + $data['total_sum'];
        }
        $data['products'] = $storageData;
        return json_encode(['data' => $data]);
    }
}