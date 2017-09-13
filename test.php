<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Результат</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php
$cells_index = array(
    '1' => array('0','0'),
    '2' => array('0', '1'),
    '3' => array('0', '2'),
    '4' => array('1', '0'),
    '5' => array('1', '1'),
    '6' => array('1', '2'),
    '7' => array('2', '0'),
    '8' => array('2', '1'),
    '9' => array('2', '2'),
);
$all_cells = array('1','2','3','4','5','6','7','8','9');
$acess_cells = array('12','23','45','56', '78', '89',
    '14', '47', '25', '58', '36', '69', '123', '456', '789', '147',
    '258', '369', '1245', '2356', '4578', '5689', '123456', '456789',
    '124578', '235689', '123456789');
/*$input = array(
    array( 'text' => 'Текст красного цвета',
        'cells' => '2145',
        'align' => 'center',
        'valign' => 'center',
        'color' => 'red',
        'bgcolor' => 'green'),
    array('text' => 'Текст зеленого цвета',
        'cells' => '98',
        'align' => 'right',
        'valign' => 'bottom',
        'color' => 'purple',
        'bgcolor' => 'orange')
);*/
$input = $_POST['gener_arr'];
function sort_cells($str) {
    $strtolist =str_split($str);
    sort($strtolist);
    $sorted_cells = implode('', $strtolist);
    return $sorted_cells;

}
foreach ($input as $key => $value) {
    $a = sort_cells($value['cells']);
    $input[$key]['cells'] = $a;
}
$cells = array();
$cellsstr = array();
foreach ($input as $value) {
    $item = explode(",", $value["cells"]); //В этом цикле я извлекаю из данного массива
    array_push($cells,$item); // значения по ключу cells и добавляю их в массив cells
}; //Array ( [0] => Array ( [0] => 1 [1] => 2 [2] => 4 [3] => 5 ) [1] => Array ( [0] => 8 [1] => 9 ) )
foreach ($cells as $value) {
    $item = implode('', $value); // трансоформирую значения массива cells в новый массив
    array_push($cellsstr, $item); //cellsstr где все значения без запятых только ячейки
};//Array ( [0] => 1245 [1] => 89 )

$result = array();
// 1 2 4 5 8 9
foreach ($cellsstr as $value) {
    $i = strlen($value);
    while ($i > 0) {
        array_push($result,$value[$i-1]);
        $i = $i -1;
    }
}
foreach ($result as $value) {
    unset($all_cells[array_search($value, $all_cells)]);
} //получаю оставшиеся ячейки

//print_r($_POST['gener_arr']);
$count_div = count($cellsstr) + count($all_cells);
//в последующих функциях вывожу стайл для разных ситуаций
function horis($first, $cells_arr, $arr_style){
    $height = 'height: 200;';
    if ($cells_arr[$first][0] == 2){
        $bottom = 'bottom: 0;';
        $top = 'top: 400px;';
        if ($cells_arr[$first][1] == 0) {
            $left = 'left: 0;';
            $right = 'right: 200px;';
        }
        elseif ($cells_arr[$first][1] == 1) {
            $left = 'left: 200px;';
            $right = 'right: 0;';
        }
        $style = '<style>'.$arr_style[1].'#bloc1 {position: absolute;
        '.$height.$left.$right.$arr_style[0].
            $top.$bottom.'}'.'
                      </style>';
        echo $style;
    }
    if ($cells_arr[$first][0] == 1) {
        $bottom = 'bottom: 200px;';
        $top = 'top: 200px;';
        if ($cells_arr[$first][1] == 0) {
            $left = 'left: 0;';
            $right = 'right: 200px;';
        }
        elseif ($cells_arr[$first][1] == 1) {
            $left = 'left: 200px;';
            $right = 'right: 0;';
        }
        $style = '<style>'.'#bloc1 {position: absolute;
                        background: blue;'.$height.$left.$right.
            $top.$bottom.'}'.'
                      </style>';
        echo $style;

    }
    if ($cells_arr[$first][0] == 0) {
        $bottom = 'bottom: 400px;';
        $top = 'top: 0px;';
        if ($cells_arr[$first][1] == 0) {
            $left = 'left: 0;';
            $right = 'right: 200px;';
        }
        elseif ($cells_arr[$first][1] == 1) {
            $left = 'left: 200px;';
            $right = 'right: 0;';
        }
        $style = '<style>'.'#bloc1 {position: absolute;'.$height.$left.$right.
            $top.$bottom.'}'.'
                      </style>';
        echo $style;
    }
}
function vert($first, $cells_arr, $arr_style){
    $height = 'heoght: 400px;';
    if ($cells_arr[$first][1] == 0){
        $left = 'left: 0;';
        $right = 'right: 400px;';
        if ($cells_arr[$first][0] == 0) {
            $top = 'top: 0;';
            $bottom = 'bottom: 200px;';
        }
        elseif ($cells_arr[$first][0] == 1) {
            $top = 'top: 200px;';
            $bottom = 'bottom: 0;';
        }
    }
    elseif ($cells_arr[$first][1] == 1) {
        $left = 'left: 200px;';
        $right = 'right: 200px;';
        if ($cells_arr[$first][0] == 0) {
            $top = 'top: 0;';
            $bottom = 'bottom: 200px;';
        } elseif ($cells_arr[$first][0] == 1) {
            $top = 'top: 200px;';
            $bottom = 'bottom: 0';
        }
    }
    elseif ($cells_arr[$first][1] == 2) {
        $left = 'left: 400px;';
        $right = 'right: 0;';
        if ($cells_arr[$first][0] == 0) {
            $top = 'top: 0;';
            $bottom = 'bottom: 200px;';
        } elseif ($cells_arr[$first][0] == 1) {
            $top = 'top: 200px;';
            $bottom = 'bottom: 0';
        }


    }
    $style = '<style>'.$arr_style[1].'#bloc1 {position: absolute;
                      background: blue;'.$height.$left.$right.$arr_style[0].
        $top.$bottom.'}'.'
                  </style>';
    echo $style;

}
function four($first, $cells_arr, $arr_style) {
    $height = 'height: 400px;';
    if ($cells_arr[$first][0] == 0) {
        $top = 'top: 0;';
        $bottom = 'bottom: 200px;';
        if ($cells_arr[$first][1] == 0) {
            $left = 'left: 0;';
            $right = 'right: 200px;';
        }
        elseif ($cells_arr[$first][1] == 1) {
            $left = 'left: 200px;';
            $right = 'right: 0;';
        }
    }
    elseif ($cells_arr[$first][0] == 1) {
        $top = 'top: 200px;';
        $bottom = 'bottom: 0;';
        if ($cells_arr[$first][0]){
            if ($cells_arr[$first][1] == 0) {
                $left = 'left: 0;';
                $right = 'right: 200px;';
            }
            elseif ($cells_arr[$first][1] == 1) {
                $left = 'left: 200px;';
                $right = 'right: 0;';}
        }
    }
    $style = '<style>'.$arr_style[1].'#bloc {position: absolute;'.$height.$left.$right.$arr_style[0].
        $top.$bottom.'}'.'
                      </style>';
    echo $style;
}
function three_horis ($first, $cells_arr,$arr_style) {
    $height = 'height: 200;';
    if ($cells_arr[$first][0] == 0){
        $bottom = 'bottom: 400px;';
        $top = 'top: 0;';
        $left = 'left: 0;';
        $right = 'right: 0;';
    }
    if ($cells_arr[$first][0] == 1){
        $bottom = 'bottom: 200px;';
        $top = 'top: 200px;';
        $left = 'left: 0;';
        $right = 'right: 0;';
    }
    if ($cells_arr[$first][0] == 2){
        $bottom = 'bottom: 0;';
        $top = 'top: 400px;';
        $left = 'left: 0;';
        $right = 'right: 0;';
    }


    $style = '<style>'.$arr_style[1].'#bloc2 {position: absolute;'.$height.$left.$right.$arr_style[0].
        $top.$bottom.'}'.'
                      </style>';

    echo $style;


}
function three_vert ($first, $cells_arr, $arr_style) {
    $height = 'height: 600px;';
    if ($cells_arr[$first][1] == 0) {
        $left = 'left: 0;';
        $right = 'right: 400px;';
        $top = 'top: 0;';
        $bottom = 'bottom: 0;';
    }
    elseif ($cells_arr[$first][1] == 1) {
        $left = 'left: 200px;';
        $right = 'right: 200px;';
        $top = 'top: 0;';
        $bottom = 'bottom: 0;';

    }
    elseif ($cells_arr[$first][1] == 2) {
        $left = 'left: 400px;';
        $right = 'right: 0;';
        $top = 'top: 0;';
        $bottom = 'bottom: 0;';

    }
    $style = '<style>'.$arr_style[1].'#bloc2 {position: absolute;'.
        $height.$left.$right.$arr_style[0].
        $top.$bottom.'}'.'
                 </style>';

    echo $style;

}
function six_horis($first, $cells_arr,$arr_style){
    $height = 'height: 400px;';
    if ($cells_arr[$first][0] == 0){
        $bottom = 'bottom: 200px;';
        $top = 'top: 0;';
        $left = 'left: 0;';
        $right = 'right: 0;';
    }
    if ($cells_arr[$first][0] == 1){
        $bottom = 'bottom: 0;';
        $top = 'top: 200px;';
        $left = 'left: 0;';
        $right = 'right: 0;';
    }
    $style = '<style>'.$arr_style[1].'#bloc6 {position: absolute;'.$height.$left.$right.$arr_style[0].
        $top.$bottom.'}'.'
                      </style>';

    echo $style;
}
function six_vert ($first, $cells_arr,$arr_style) {
    $height = 'height: 600px;';
    if ($cells_arr[$first][1] == 0){
        $left = 'left: 0;';
        $right = 'right: 200px;';
        $bottom = 'bottom: 0;';
        $top = 'top: 0;';
    }
    if ($cells_arr[$first][1] == 1){
        $left = 'left: 200px;';
        $right = 'right: 0;';
        $bottom = 'bottom: 0;';
        $top = 'top: 0;';
    }
    $style = '<style>'.$arr_style[1].'#bloc6 {position: absolute;'
        .$height.$left.$right.$arr_style[0].
        $top.$bottom.'}'.'
                      </style>';

    echo $style;
}
function nine($arr_style) {
    $height = 'height: 600px;';
    $width = 'width: 600px;';
    $style = '<style>'.$arr_style[1].'#bloc9 {position: absolute;'.$height.$width.$arr_style[0].'}'.'
                      </style>';

    echo $style;
}
$html ='';
function param($param, $h, $id){
    if ($param['align'] == 'center'){
        $ta = 'text-align: center;';
    }
    elseif ($param['align'] == 'left'){
        $ta = 'text-align: left;';
    }
    elseif ($param['align'] == 'right'){
        $ta = 'text-align: right;';
    }
    $color ='color:'. $param['color'].';';
    $bgcolor = 'background:'.$param['bgcolor'].';';
    if ($param['valign'] == 'center'){
        $ofs = ($h-30)/2;
        $va = '#'.$id.'{padding-top:'.$ofs.'px;padding-bottom:'.$ofs.'px;margin:0;}';
    }
    elseif ($param['valign'] == 'top'){
        $ofs = ($h - 30);
        $va = '#'.$id.'{padding-top:10px;padding-bottom:'.$ofs.'px;}';
    }
    elseif ($param['valign'] == 'bottom'){
        $ofs = ($h - 60);
        $va = '#'.$id.'{padding-top:'.$ofs.'px;padding-bottom:30px;}';
    }
    $resu = $ta.$color.$bgcolor;
    $par_array  = array();
    array_push($par_array, $resu);
    array_push($par_array, $va);
    return $par_array;
}
foreach ($input as $value) {
    if (in_array($value['cells'], $acess_cells)) {
        if (strlen($value['cells']) == 4) {
            $par_arr = param($value, 400, 'four');
            four($value['cells'][0], $cells_index, $par_arr);
            $block4 = '<div id="bloc" class="border"><h5 id="four">'.$value['text'].'</h5></div>';
            $html= $html.$block4;
        }
        if (strlen($value['cells']) == 2){
            if ($cells_index[$value['cells'][0]][0] == $cells_index[$value['cells'][1]][0]) {
                $par_arr = param($value, 200, 'two');
                horis($value['cells'][0],$cells_index,$par_arr);
            } //горизонтальные двойки
            elseif ($cells_index[$value['cells'][0]][0] + 1 == $cells_index[$value['cells'][1]][0]) {
                $par_arr = param($value, 400,'two');
                vert($value['cells'][0],$cells_index,$par_arr);
            } //вертикальные двойки
            $block2 = '<div id="bloc1" class="border"><h5 id="two">'.$value['text'].'</h5></div>';
            $html = $html.$block2;
        }
        if (strlen($value['cells']) == 3) {
            if ($cells_index[$value['cells'][0]][0] == $cells_index[$value['cells'][1]][0]) {
                $par_arr = param($value, 200, 'three');
                three_horis($value['cells'][0], $cells_index,$par_arr);

            }
            elseif ($cells_index[$value['cells'][0]][0] + 1 == $cells_index[$value['cells'][1]][0]) {
                $par_arr = param($value, 600,'three');
                three_vert($value['cells'][0], $cells_index,$par_arr);
            }
            $block3 = '<div id="bloc2" class="border"><h5 id="three">'.$value['text'].'</h5></div>';
            $html = $html.$block3;
        }
        if (strlen($value['cells']) == 6) {
            if($cells_index[$value['cells'][0]][0] == $cells_index[$value['cells'][1]][0] and
                $cells_index[$value['cells'][1]][0] == $cells_index[$value['cells'][2]][0]){
                $par_arr = param($value, 400, 'six');
                six_horis($value['cells'][0], $cells_index, $par_arr);
            }
            elseif($cells_index[$value['cells'][0]][0]+1 == $cells_index[$value['cells'][2]][0] and
                $cells_index[$value['cells'][2]][0] +1  == $cells_index[$value['cells'][4]][0]){
                $par_arr = param($value, 600, 'six');
                six_vert($value['cells'][0], $cells_index,$par_arr);
            }

            $block6 =  '<div id="bloc6" class="border"><h5 id="six">'.$value['text'].'</h5></div>';
            $html = $html.$block6;

        }
        if (strlen($value['cells'])== 9) {
            $par_arr = param($value, 600, 'nine');
            print_r($par_arr);
            nine ($par_arr);
            $block9 = '<div id="bloc9" class="border"><h5 id="nine">'.$value['text'].'</h5></div>';
            $html = $html.$block9;
        }
        $ones_items = array();

        foreach ($cells_index as $key => $value) { //связываю оставшиеся одинарные с массивом где находятся индексы
            //echo $key.' = ';print_r($cells_index[$key]); вывести ключ значение в массиве с индексами
            //echo '<hr>';
            foreach ($all_cells as $item){
                if ($item == $key) {
                    array_push($ones_items, $cells_index[$key]);
                }
            }
        }

        $style_array_one = array();
        foreach ($ones_items as $value) { // получаю css куски для каждого одинарного елемента
            $height = 'height: 200px;';
            if ($value[0] == 0) {
                $top = 'top:0;';
                $bottom = 'bottom:0;';
                if ($value[1] == 0){
                    $left = 'left: 0;';
                    $right = 'right: 400px;';
                }
                elseif ($value[1] == 1) {
                    $left = 'left: 200px;';
                    $right = 'right: 200px;';
                }
                elseif ($value[1] == 2) {
                    $left = 'left: 400px;';
                    $right = 'right: 0;';
                }
            }
            elseif ($value[0] == 1) {
                $top = 'top: 200px;';
                $bottom = 'bottom: 200px;';
                if ($value[1] == 0){
                    $left = 'left: 0;';
                    $right = 'right: 400px;';
                }
                elseif ($value[1] == 1) {
                    $left = 'left: 200px;';
                    $right = 'right: 200px;';
                }
                elseif ($value[1] == 2) {
                    $left = 'left: 400px;';
                    $right = 'right: 0;';
                }

            }
            elseif ($value[0] == 2) {
                $top = 'top: 400px;';
                $bottom = 'bottom: 0;';
                if ($value[1] == 0){
                    $left = 'left: 0;';
                    $right = 'right: 400px;';
                }
                elseif ($value[1] == 1) {
                    $left = 'left: 200px;';
                    $right = 'right: 200px;';
                }
                elseif ($value[1] == 2) {
                    $left = 'left: 400px;';
                    $right = 'right: 0;';
                }
            }
            $item_style = $height.$top.$bottom.$left.$right;
            array_push($style_array_one, $item_style);

        }
        $i = 0;
        foreach ($style_array_one as $value) { //вывожу готовый стайл для каждого одинраного сегмента
            $one = '<div id="one'.$i.'"class="border"></div>';
            echo '<style>
                 #one'.$i.'{position: absolute;
            background: red;'.$value
                .'}</style>';
            $html = $html.$one;
            $i++;
        }
        echo '<div id="parent">
            '.$html.'
          </div>';
    }
    else {
        echo '<h1>'.'wrong rectangle restart page and try one more time'.'</h1>';
    }

};



?>

</body>
</html>