<?php
namespace Shop\Service;

class Product
{
    /**
     * @return mixed
     */
    public function getProductsList()
    {
        return $this->getProductsFromSource();
    }

    /**
     * @param $id
     * @return array|null
     */
    public function getProductByProductId($id)
    {
        return $this->findProductByProductId($id);
    }

    /**
     * @param $id
     * @return null | array
     */
    protected function findProductByProductId($id)
    {
        $products = $this->getProductsFromSource();
        foreach($products as $product){
            if($product['id'] == $id){
                return new \Shop\Model\Product($product);
            }
        }

        return null;
    }

    /**
     * @return mixed
     */
    protected function getProductsFromSource()
    {
        return include __DIR__ . '/../../../config/data.php';
    }
}