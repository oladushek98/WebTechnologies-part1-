<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Laba4</title>
  </head>
  <body>
    <!--<form class="webform" action="/lab4.ph" method="post" >
      <fieldset>
        <legend>Which way?</legend>
        <p><label> Romans to Arabic </label> <input type="radio" name="variant" value="one"></p>
        <p><label> Arabic to Romans </label> <input type="radio" name="variant" value="two"></p>
      </fieldset>
      <input type="submit" name="button" value="Send">
      <br><br><br>
    </form>-->
    <form class="webform" action="/lab4.php" method="post">
      <p><input type="text" name="converter" value="">
      <input type="submit" name="button" value=""></p>
    </form>


  </body>
</html>




<?php

  function getfile()
  {
    if (is_file('input.txt'))
    {
      $text = file_get_contents('input.txt');
    }
    else
    {
      die('File not found');
    }
    return $text;
  }

  function number_to_roman($value)
  {
    if ($value < 0) return "";
    if (!$value) return "0";
    $thousands=(int)($value / 1000);
    $value -= $thousands * 1000;
    $result = str_repeat("M", $thousands);
    $table = array(
        900=>"CM", 500=>"D", 400=>"CD", 100=>"C",
        90=>"XC", 50=>"L", 40=>"XL", 10=>"X",
        9=>"IX", 5=>"V", 4=>"IV", 1=>"I");
    while($value) {
        foreach ($table as $part => $fragment) if ($part <= $value) break;
            $amount=(int)($value/$part);
        $value -= $part*$amount;
        $result .= str_repeat($fragment,$amount);
    }
    return $result;
  }

  /*if (isset($_POST['button']))
  {*/

    /*switch ($_POST['variant'])
    {
      case 'one':
        $var = 'romans';
        break;
      case 'two':
        $var = 'arabic';
        break;
    }*/

    if (isset($_POST['button']))
    {
      $num = ($_POST['converter']);
      $out = number_to_roman((int)$num);
      echo ((string)$out);
      echo '<br/>';
    }

    echo '<br/><br/><br/>';

    $text = getfile();

    $text = preg_replace_callback('/\d+/', function ($x)
      {
          return '<span style="color:red">'.$x[0].'</span>';
      },
        $text);
    echo $text;
    echo '<br/><br/><br/>';

    $text = preg_replace_callback('/\d+/', function ($x)
      {
          return '<span style="color:red">'.number_to_roman($x[0]).'</span>';
      },
        $text);
    echo $text;

//  }


?>
