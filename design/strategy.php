<?php
/**
 * @Date  : 3/27/21 6:23 PM
 * @Author: shupan
 * @File  : strategy.php
 * @Desc  : 策略模式，给文件排序。 按照文件大小，分别采用快排，外部排序，mapReduce排序
 *
 *        策略的定义、策略的创建、策略的使用
 *
 *        问题：此类场景用模板方法是不是也可以解决？
 */


interface ISortAlg {
    public function sort();
}


class QuickSort implements ISortAlg {
    public function sort() {
        echo "execute QuickSort\n";
    }
}

class ExternalSort implements ISortAlg {
    public function sort() {
        echo "execute ExternalSort\n";
    }
}


class MapreduceSort implements ISortAlg {
    public function sort() {
        echo "execute MapreduceSort\n";

    }
}


class Sorter {

    private $path;

    private $sortAlg;

    public function __construct($path) {
        $this->path = $path;
    }

    public function sortFile() {
        $filesize = $this->getFileSize();
        if ($filesize <= 100) {
            $this->sortAlg = new QuickSort();
        } elseif ($filesize <= 10000) {
            $this->sortAlg = new ExternalSort();
        } else {
            $this->sortAlg = new MapreduceSort();
        }
        $this->sortAlg->sort();
    }

    private function getFileSize() {
        return 100000;
    }
}


$sorter = new Sorter('/home/xiaoju/shupan/1.txt');
$sorter->sortFile();