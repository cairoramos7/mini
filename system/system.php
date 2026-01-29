<?php
class System{
    private $url;
    private $segments;
    public $controller;
    public $action;
    public $params;

    public function __construct(){
        $this->setUrl();
        $this->setSegments();
        $this->setController();
        $this->setAction();
        $this->setParams();
    }

    private function setUrl(){
        $_GET['url'] = (isset($_GET['url']) ? $_GET['url'] : 'index/index');
        $this->url = $_GET['url'];
    }

    private function setSegments(){
        $this->segments = explode('/', $this->url);
    }

    private function setController(){
        $this->controller = $this->segments[0];
    }

    private function setAction(){
        $ac = (!isset($this->segments[1]) || $this->segments[1] == null || $this->segments[1] == "index" ? "index" : $this->segments[1]);
        $this->action = $ac;
    }

    private function setParams(){
        unset($this->segments[0], $this->segments[1]);
        if(empty(end($this->segments)))
            array_pop($this->segments);

        $i = 0;
        if(!empty($this->segments)){
            foreach($this->segments as $val){
                if($i % 2 == 0){
                    $ind[] = $val;
                }else{
                    $value[] = $val;
                }
                $i++;
            }
        }else{
            $ind = array();
            $value = array();
        }

        if(count($ind) == count($value) && !empty($ind) && !empty($value))
            $this->params = array_combine($ind, $value);
        else
            $this->params = array();
    }

    public function getParam($name = null){
        if($name != null)
            return $this->params[$name];
        else
            return $this->params;
    }

    public function run(){
        $controllerName = ucfirst($this->controller) . 'Controller';
        $controller_path = CONTROLLERS . $controllerName . '.php';

        if (!file_exists($controller_path))
            die("Houve um erro. O controller não existe.");

        require_once($controller_path);
        $app = new $controllerName();
        if (!method_exists($app, $this->action))
            die("Houve um erro. A action não existe.");

        $action = $this->action;
        $app->$action();
    }
}
