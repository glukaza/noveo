<?php

namespace Shop\Controller;

use Shop\Service\Cart;
use Shop\Service\Product;
use Shop\Helper\ErrorReporting;
use Shop\Service\Storage;

class ApiController
{
    protected $prodcutService;

    protected $errorReporting;

    protected $storage;

    public function __construct()
    {
        $this->prodcutService = new Product();
        $this->errorReporting = new ErrorReporting();
        $this->storage = new Storage();
    }

    /**
     * @return string
     */
    public function getListAction()
    {
        return json_encode(["data" => $this->getProducts()]);
    }

    /**
     * @return \Shop\Service\Adapter|string
     */
    public function setCartAction()
    {
        $post = $_POST;
        if(empty($post["quantity"])
            || empty($post["product_id"])
            || ((int)$post["quantity"] < 0)
            || ((int)$post["quantity"] > 10)
        ){
            return $this->errorReporting->invalidParams();
        }

        $product = $this->getProductById($post["product_id"]);
        if(empty($product)) {
            return $this->errorReporting->invalidParams();
        }

        return $this->storage->setDataStorage($product, $post["quantity"]);
    }

    /**
     * @return mixed
     */
    public function getCartAction()
    {
        $cart = new Cart();
        if(!$this->storage->getDataStorage()) {
            return json_encode(['not product in cart']);
        }
        return $cart->getCart($this->storage->getDataStorage());
    }

    public function removeCartAction($productID)
    {
        $product = $this->getProductById($productID);
        if(empty($product)) {
            return $this->errorReporting->invalidParams();
        }

        return $this->storage->updateDataStorage($productID);
    }

    /**
     * @return mixed
     */
    protected function getProducts()
    {
        return $this->prodcutService->getProductsList();
    }

    /**
     * @param $id
     * @return array|null
     */
    protected function getProductById($id)
    {
        return $this->prodcutService->getProductByProductId($id);
    }
}