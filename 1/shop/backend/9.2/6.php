
<?php
 class People{
  public function sayHi(){
        echo "hi";
    }
}
class Person extends People
{
    public function sayHi(){
        parent::sayHi();
        echo "hello";
    }
}
$p1 = new Person();
$p1->sayhi();
