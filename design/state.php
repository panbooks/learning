<?php
/**
 * @Date  : 3/27/21 7:00 PM
 * @Author: shupan
 * @File  : state.php
 * @Desc  : 状态模式，超级马里奥.
 *        1、分支逻辑法  2、查表法  3、状态模式：每个状态定义一个类，再定义事件（对应类中方法）
 *
 *        第三种实现方式需要仔细琢磨一下。 有多个表示状态的类，还有一个状态机，最终使用其实是一个状态机。
 *
 *        一个马里奥对应一个状态机，状态机中的状态在不停的变化。
 *
 *        所以状态机对象中包含状态参数，和分值，状态类中不包含成员变量，方法中只接受状态机作为参数
 */

class State {

    const SMALL = 0;
    const MIDDLE = 1;
    const FIRE = 2;

}


abstract class Mario {

    private $stateMachine;

    public function __construct(MarioStateMachine $stateMachine) {
        $this->stateMachine = $stateMachine;
    }

    abstract public function obtainMushroom(MarioStateMachine $stateMachine);

    abstract public function obtainFireFlower(MarioStateMachine $stateMachine);

    abstract public function meetMonster(MarioStateMachine $stateMachine);
}


class SmallMario extends Mario {


    public function obtainMushroom(MarioStateMachine $stateMachine) {
        $stateMachine->setCurrentState(new MiddleMario($stateMachine));
    }

    public function obtainFireFlower(MarioStateMachine $stateMachine) {
        $stateMachine->setCurrentState(new FireMario($stateMachine));
    }

    public function meetMonster(MarioStateMachine $stateMachine) {
        $stateMachine->setCurrentState(new SmallMario($stateMachine));
    }
}


class MiddleMario extends Mario {

    public function obtainMushroom(MarioStateMachine $stateMachine) {
        $stateMachine->setCurrentState(new MiddleMario($stateMachine));
    }

    public function obtainFireFlower(MarioStateMachine $stateMachine) {
        $stateMachine->setCurrentState(new FireMario($stateMachine));
    }

    public function meetMonster(MarioStateMachine $stateMachine) {
        $stateMachine->setCurrentState(new SmallMario($stateMachine));
    }
}

class FireMario extends Mario {

    public function obtainMushroom(MarioStateMachine $stateMachine) {
        $stateMachine->setCurrentState(new FireMario($stateMachine));
    }

    public function obtainFireFlower(MarioStateMachine $stateMachine) {
        $stateMachine->setCurrentState(new FireMario($stateMachine));
    }

    public function meetMonster(MarioStateMachine $stateMachine) {
        $stateMachine->setCurrentState(new SmallMario($stateMachine));
    }
}


class MarioStateMachine {

    private $score;
    private $state;

    public function __construct() {
        $this->state = new SmallMario($this);
        $this->score = 0;
    }


    public function obtainMushroom() {
        $this->state->obtainMushroom($this);
        $this->score += 100;
    }

    public function obtainFireFlower() {
        $this->state->obtainFireFlower($this);
        $this->score += 300;
    }

    public function meetMonster() {
        $this->state->meetMonster($this);
        $this->score -= 300;
    }

    public function setCurrentState($state) {
        $this->state = $state;
    }

    public function getCurrentState() {
        return $this->state;
    }

    public function printDetail() {
        echo "score:" . $this->score . "\t" . "state:" . get_class($this->state) . "\n";
    }

}


$mario = new MarioStateMachine();
$mario->obtainMushroom();
$mario->printDetail();
$mario->obtainMushroom();
$mario->printDetail();

$mario->obtainFireFlower();
$mario->printDetail();

$mario->obtainFireFlower();
$mario->printDetail();

$mario->meetMonster();
$mario->printDetail();

