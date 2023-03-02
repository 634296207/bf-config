<?php

namespace bbb;

function demo()
{
    echo 'bbb';
}

include 'aaa.php';
demo(); // bbb
echo "\n";
var_dump(__NAMESPACE__); // bbb
echo "\n";
\aaa\demo(); // 可以使用aaa.php的命名空间