<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$this->title = 'Array';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
  <?php


  $array = ['aaa','bbb','ccc'];
  $array2 = [ 'dog'=>'dogs',
              'cat'=>'cats',
              'rat'=>'rats'
            ];
  $array3 = [ 'A'=>['1'=>'AAA'],
              'B'=>['bbb','BBB'],
              'C'=>[
                    'class'=>'show div class',
                    'html'=>'show html code',
                  ]
            ];
  $all = ArrayHelper::merge($array,$array2,$array3);
  $array3['C']['fullname'] = ['name'=>'myname','lname'=>'mylastname'];
  //$array2 = ['aaa','bbb','ccc'];
  echo "array[0] = ".$array[0].'<br>';
  echo "array[1] = ".$array[1].'<br>';
  echo "array[2] = ".$array[2].'<br>';
  echo '<hr>';
  echo "array[dog] = ".$array2['dog'].'<br>';
  echo "array[cat] = ".$array2['cat'].'<br>';
  echo "array[rat] = ".$array2['rat'].'<br>';
  echo '<hr>';
  echo "print_r (array3) = ";
  echo "<pre>";
  print_r($array3);
  echo "</pre>";
  echo "<br>";
  echo "array['A']['1'] = ".$array3['A']['1'].'<br>';
  echo "array['B']['0'] = ".$array3['B']['0'].'<br>';
  echo "array['B']['1'] = ".$array3['B']['1'].'<br>';
  echo "array3['C']['class'] = ".$array3['C']['class'].'<br>';
  echo "array3['C']['fullname']['name'] = ".$array3['C']['fullname']['name'].'<br>';
  echo "<pre>";
  print_r($all);
  echo "</pre>";

  ?>
</div>
