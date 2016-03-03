<?php
namespace Shop\Service;


class Adapter
{
    /**
     * @param $data
     */
    public function setData($data)
    {
        $_SESSION['products'] = $this->prepareForSaving($data);
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        if(!empty($_SESSION['products'])) {
            return unserialize($_SESSION['products']);
        }

        return null;
    }

    protected function prepareForSaving($data)
    {
        return serialize($data);
    }
}