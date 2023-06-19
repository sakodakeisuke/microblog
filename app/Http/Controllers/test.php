<?php

class Cat {
    
    public $name;
    public $age;
    
    public function shout(){
        echo 'にゃー';
    }

    public function introduce(){
        echo '名前は'.$this->name.$this->age.'です';
        $this->shout();
    }
}

     $taro=new Cat;
     $taro->name='太郎';
     $taro->age=3;