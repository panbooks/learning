<?php
/**
 * @Date  : 3/27/21 6:45 PM
 * @Author: shupan
 * @File  : responsechain.php
 * @Desc  : 职责链模式，通用场景，对一个请求一次执行多个过滤器
 *        写着写着，怎么觉得跟观察者模式有点像
 */


interface IHandler {
    public function handle();
}

class HandlerA implements IHandler {
    public function handle() {
        echo "do handle A\n";
    }
}

class HandlerB implements IHandler {
    public function handle() {
        echo "do handle B\n";
    }
}


class HandlerChain {

    private $handlers;

    public function __construct() {
        $this->handlers = new SplObjectStorage();
    }

    public function addHandler(IHandler $handler) {
        $this->handlers->attach($handler);
    }

    public function removeHandler(IHandler $handler) {
        $this->handlers->detach($handler);
    }

    public function handle($req) {
        foreach ($this->handlers as $handler) {
            $handler->handle($req);
        }
    }
}


$handlerChain = new HandlerChain();
$handlerA = new HandlerA();
$handlerB = new HandlerB();
$handlerChain->addHandler($handlerA);
$handlerChain->addHandler($handlerB);
$handlerChain->handle($req);
