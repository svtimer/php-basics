<?php

declare(strict_types=1);
$str1 = " Hello World! ";
$str2 = "Привіт";
echo strlen($str1), "\n";
echo strlen($str2), "\n";
echo mb_strlen($str1), "\n";
echo mb_strlen($str2), "\n";

$rows = ["Hello", "Привіт", "Номер"];
foreach ($rows as $s) {
    echo sprintf('%-12s', $s), "|\n";
}
?>