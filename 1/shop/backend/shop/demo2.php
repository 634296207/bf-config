<?php

interface T1{
    public function Miss();
}

interface T2{
    public function Mr();
}

class sontest implements T1,T2{
    public function Miss()
    {
        echo "MIss";
    }

    public function Mr()
    {
        echo "Mr";
    }
}

class datest extends sontest{}

$obj = new datest();
var_dump($obj instanceof T1);
var_dump($obj instanceof T2);
var_dump($obj instanceof datest);
var_dump($obj instanceof sontest);