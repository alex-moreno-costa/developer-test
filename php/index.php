<?php
header('Content-Type: application/json');
require __DIR__ . '/autoload.php';

$request = new Request('31.804.115/0002-43');
$output = $request->run();

$filter = new FilterOutput($output);
$json = $filter->getJSON();
echo $json;