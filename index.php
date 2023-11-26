<php

 function sumArrays($numberJson, $shouldFormat): string {
        $mainArray = json_decode($numberJson, true);
        $maxLen = max(array_map('count', $mainArray));
        $carry = 0;
        $result = [];

        for ($i = 0; $i < $maxLen; $i++) {
            foreach ($mainArray as $numberArray) {
                $index = count($numberArray) - $i - 1;
                if ($index >= 0) {
                    $carry += $numberArray[$index];
                }
            }

            array_unshift($result, $carry % 10);
            $carry = floor($carry / 10);
        }

        while ($carry > 0) {
            array_unshift($result, $carry % 10);
            $carry = floor($carry / 10);
        }

        return $shouldFormat ? number_format(implode($result), 0, ".", ",") : implode($result);
    }

    $array = [
        [4,5,6],
        [6,5,4],
        [1,2,3],
        [3,2,1],
        [1,2,3],
        [2,9,8,3,7,4]
    ];
    echo sumArrays(strval(json_encode($array)), true);
    echo "<br>";
    echo sumArrays(strval(json_encode([[3, 4, 0, 8, 5, 7, 8, 2, 3, 4, 9, 5, 7, 3, 8, 4, 9, 2, 5, 7, 2, 8, 3, 9, 4, 5, 7, 2, 3, 4, 8, 9, 5, 7, 2, 3, 8, 9, 4, 5, 7], [2, 4, 9, 8, 7, 5, 6, 3, 2, 6, 4, 8, 7, 5, 6, 9, 1, 7, 4, 2, 3, 5, 4, 7, 8, 3, 2, 7, 4, 5, 4, 3, 6, 9, 8, 5, 4, 3, 6, 9, 3, 8, 4, 5, 9, 2, 3, 0, 0, 2, 3, 4, 9, 0, 2, 3, 4, 9, 2]])), true);


?>
