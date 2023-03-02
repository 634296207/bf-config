<?php
class Preson {
    var $name = null;
    var $age = null;
    var $sex = null;
    public function __construct($a,$b,$c){
        $this->name = $a;
        $this->age = $b;
        $this->age = $c;
    }

}
$student1 = new Preson('zhengshan1','18','male');
$student2 = new Preson('zhengshan2','18','male');
$student3 = new Preson('zhengshan3','18','male');
echo $student1->name;
echo $student2->name;
echo $student3->name;