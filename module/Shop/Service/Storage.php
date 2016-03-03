<?php
namespace Shop\Service;

use Shop\Service\Adapter;

class Storage
{
    /** @var \Shop\Service\Adapter  */
    protected $storage;

    /**
     * Storage constructor.
     */
    public function __construct()
    {
        $this->storage = new Adapter();
    }

    /**
     * @return mixed
     */
    public function getDataStorage()
    {
        return $this->storage->getData();
    }

    /**
     * @param $productID
     * @return string
     */
    public function updateDataStorage($productID)
    {
        $storage = $this->getDataStorage();
        if(!$storage[$productID]) {
            return json_encode(['not product in cart']);
        }

        $storage[$productID]->quantity = (int)$storage[$productID]->quantity - 1;
        if ($storage[$productID]->quantity == 0) {
            unset($storage[$productID]);
        }
        $this->storage->setData($storage);
        return json_encode(['success']);
    }

    /**
     * @param $product
     * @param $count
     * @return string
     */
    public function setDataStorage($product, $count)
    {
        $storage = $this->getDataStorage();

        if (empty($storage[$product->id])) {
            $storage[$product->id] = new \stdClass();
            $storage[$product->id]->id = $product->id;
            $storage[$product->id]->quantity = $count;
            $storage[$product->id]->price = $product->price * $count;
        } else {
            $storage[$product->id]->quantity = (int)$count + (int)$storage[$product->id]->quantity;
            $storage[$product->id]->price = $product->price * $storage[$product->id]->quantity;
        }

        $this->storage->setData($storage);
        return json_encode(['success']);
    }
}