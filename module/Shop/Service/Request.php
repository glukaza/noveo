<?php

namespace Shop\Service;

use Shop\Controller\ApiController;
use Shop\Helper\ErrorReporting;

class Request
{
    /** @var string */
    public $method;

    /** @var string */
    public $url;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->url = $_SERVER['REQUEST_URI'];
        $this->errorReporting = new ErrorReporting();
        $this->config = $this->getConfig();
    }

    /**
     * @return string
     */
    public function route()
    {
        $path = parse_url($this->url, PHP_URL_PATH);
        $pathArray = explode('/', $path);
        array_shift($pathArray);

        if($pathArray[0] != $this->config['root_url']){
            return $this->errorReporting->get404();
        }

        foreach($this->config['allow'] as $item){
            if($item['url'] == $pathArray[1] && $this->method == $item['method']){
                $api = new ApiController();
                $action = $item["action"];

                if(method_exists($api, $action)) {
                    if($this->method == "DELETE"){
                        return $api->$action($pathArray[2]);
                    }
                    return $api->$action();
                }else{
                    return $this->errorReporting->actionIsNotAllowed($action);
                }
            }
        }

        return $this->errorReporting->methodIsNotAllowed($this->method);
    }

    /**
     * @return string
     */
    protected function getRequestMethod()
    {
        return $this->method;
    }

    /**
     * @return array
     */
    protected function getConfig()
    {
        return include __DIR__ . '/../../../config/config.php';
    }
}