
<?php

interface MyInterface
{
    const NUM = 123;

    public function func();

    public function test();
}

class MyClass implements MyInterface
{
    public function func()
    {

    }

    public function test()
    {
        echo 'hello';
    }
}
