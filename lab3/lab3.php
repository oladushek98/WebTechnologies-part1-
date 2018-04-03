<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Laba3</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <form class="webform" action="/lab3.php" method="post">
      <fieldset class="components">
        <legend><center>Data for the search</center></legend>
        <p><label> Path </label> <input type="text" name="path" value="" size=30/> </p>
        <p><label> Left timeborder</label> <input type="datetime-local" name="date1" value="" size=30/></p>
        <p><label> Right timeborder</label> <input type="datetime-local" name="date2" value="" size=30/></p>
        <p><label> Letter combination</label> <input type="text" name="name" value="" size=30/></p>
      </fieldset>
      <p><center><input class="button" type="submit" name="button" value="Отправить ответ"></center></p>
    </form>

    <?php
      function Search($path, $date_begin, $date_end, $name, $count)
      {
        if ($dh = opendir($path))
        {
          while (($file = readdir($dh)) !== false)
          {
            $temp = filectime($path.'\\'.$file) + 10800;
            if($file == '.' || $file == '..') continue;
            if(is_dir($path.'\\'.$file))
              Search($path.'\\'.$file, $date_begin, $date_end, $name, $count);
            else if ((strpos(basename($file), $name) !== false)
              && (($temp > $date_begin) && ($temp < $date_end)))
              {
                echo ($path.'\\'.basename($file) );
                echo "<br/>";
                $count++;
              }
          }
          closedir($dh);
        }
      }

      if (isset($_POST['button']))
      {
        $path = ($_POST['path']);
        $date_begin = strtotime(($_POST['date1']));
        $date_end = strtotime(($_POST['date2']));
        $name = ($_POST['name']);
        $count = 0;
        Search($path, $date_begin, $date_end, $name, $count);
        /*if ($count == 0)
          echo "Nothng founded!";*/
      }

     ?>

  </body>
</html>
