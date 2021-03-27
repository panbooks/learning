<?php
/**
 * @Date  : 3/27/21 5:47 PM
 * @Author: shupan
 * @File  : templatemethod.php
 * @Desc  : 模板方法
 *
 *        现实场景：模板方法可用于建造房屋， 每个建造步骤
 * （例如打地基、 建造框架、 建造墙壁和安装水电管线等） 都能进行微调， 这使得成品房屋会略有不同。
 */

/**
 * 模板抽象类
 * Class AbstractClass
 */
abstract class AbstractClass {

    //做菜
    public function TemplateMethod() {

        $this->method1(); //准备食材
        $this->method2(); //炒菜
    }

    abstract protected function method1();

    abstract protected function method2();

}

/**
 * 具体实现类，西红柿鸡蛋
 * Class ConcreteClass1
 */
class ConcreteClass1 extends AbstractClass {
    protected function method1() {
        echo "prepare tomato and egg\n";
    }

    protected function method2() {
        echo "cook with small fire\n";
    }
}

/**
 * 具体实现类，做鱼
 * Class ConcreteClass2
 */
class ConcreteClass2 extends AbstractClass {
    protected function method1() {
        echo "prepare fish\n";
    }

    protected function method2() {
        echo "cook with big fire and took a long time";
    }
}


$obj1 = new ConcreteClass1();
$obj1->TemplateMethod();

$obj2 = new ConcreteClass2();
$obj2->TemplateMethod();