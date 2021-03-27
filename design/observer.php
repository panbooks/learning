<?php


/**
 * @Date  : 3/27/21 4:52 PM
 * @Author: shupan
 * @File  : observer.php
 * @Desc  : 观察者模式，此时发现一丝java相对于php的优势。
 *        java中直接可以用list<Object>的方式观察者对象
 *
 *        现实场景：报纸订阅
 */

/**
 * 主题，被观察者
 * Interface subject
 */
interface Subject {

    public function addObserver(Observer $observer);

    public function removeObserver(Observer $observer);

    public function notifyObservers();
}

/**
 * 观察者
 * Interface Observer
 */
interface Observer {
    public function update(User $user);
}



class PromotionObserver implements Observer {

    public function update(User $user) {
        // TODO: Implement update() method.
        echo "PromotionObserver update\t" . $user->username . "\n";
    }
}


class CouponObserver implements Observer {

    public function update(User $user) {
        // TODO: Implement update() method.
        echo "CouponObserver update\t" . $user->password . "\n";
    }
}


class RegSubject implements Subject {

    private $user;

    private $observers;

    public function __construct(User $user) {
        $this->user = $user;
        $this->observers = new SplObjectStorage();
    }

    public function addObserver(Observer $observer) {
        $this->observers->attach($observer);
    }

    public function removeObserver(Observer $observer) {
        $this->observers->contains($observer) && $this->observers->detach($observer);
    }

    public function notifyObservers() {
        foreach ($this->observers as $observer) {
            $observer->update($this->user);
        }
    }


    public function register() {
        //register success
        echo "register success. save username and password\n";
        $this->notifyObservers();
    }

}

class User {
    public $username;
    public $password;

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }
}

$user = new User("shpuan", "123456");
$reg = new RegSubject($user);
$promotionObserver = new PromotionObserver();
$couponObserver = new CouponObserver();
$reg->addObserver($promotionObserver);
$reg->addObserver($couponObserver);
$reg->register();
$reg->removeObserver($couponObserver);
$reg->register();



