<?php
function task1()
{
    $fileData = file_get_contents('src/users.xml');
    $xml = new SimpleXMLIterator($fileData);

    foreach ($xml->Address as $user) {
        echo $user->Name->__tostring() . "<br>";
        echo $user->Street->__tostring() . "<br>";
        echo $user->City->__tostring() . "<br>";
        echo $user->State->__tostring() . "<br>";
        echo $user->Zip->__tostring() . "<br>";
        echo $user->Country->__tostring() . "<br>";
        echo $user->attributes()->Type . "<br>";
        echo "<hr>" . "<br>";
    }

    echo $xml->DeliveryNotes . "<br>" . "<br>";

    foreach ($xml->Items->Item as $user) {
        echo $user->ProductName->__tostring() . "<br>";
        echo $user->Quantity->__tostring() . "<br>";
        echo $user->USPrice->__tostring() . "<br>";
        if (isset($user->Comment)) {
            echo $user->Comment->__tostring() . "<br>";
        }
        if (isset($user->ShipDate)) {
            echo $user->ShipDate->__tostring() . "<br>";
        }
        echo "<hr>" . "<br>";
    }
}

function task2($arr, $repeat)
{
    $fileJson = json_encode($arr);
    file_put_contents('src/output.json', $fileJson);

    $flag = 1;
    $json = json_decode(file_get_contents('src/output.json'), true);
    for ($i = 1; $i < $repeat; $i++) {
        $num = 3;
        $num++;
        $json[] = [
            'name' => "name $num",
            'id' => $num,
            "property" => ['city' => 'spb']
        ];

        file_put_contents('src/output2.json', json_encode($json));
        $flag++;
    }

    $arr1 = json_decode(file_get_contents('src/output.json'), true);
    $arr2 = json_decode(file_get_contents('src/output2.json'), true);

    $diff = array_diff_assoc($arr2, $arr1);
    echo "<pre>";
    var_dump($diff);

}

function task3()
{
    $randomArr = [];
    for ($i = 1; $i <= 50; $i++) {
        $randomArr[] = [mt_rand(1, 100)];
    }

    $data = fopen('data.csv', 'w');
    foreach ($randomArr as $item) {
        //var_dump($item);
        fputcsv($data, $item, ';');
    }

    $fp = fopen('data.csv', 'r');
    if (!$fp) {
        die;
    }

    $csvSum = 0;

    for ($i = 0; $num = fgetcsv($fp, 100 * 100, ';');) {
        if ($num[$i] % 2 === 0) {
            $csvSum += $num[$i];
        }
    }

    return $csvSum;
}

function task4()
{
    $getData = file_get_contents('https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json');
    $data = json_decode($getData, true);
    echo '<pre>';
    echo $data['query']['pages'][15580374]["pageid"];
    echo $data['query']['pages'][15580374]["title"];
}