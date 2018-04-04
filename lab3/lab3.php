<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Laba3</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <form class="webform" action="/lab3.php" method="post">
      <fieldset class="components" >
        <legend><center>Data for the search</center></legend>
        <p><label> Path </label> <input class = "ggg" type="text" name="path" value="" size=25/> </p>
        <p><label> Left timeborder</label> <input class = "ggg" type="datetime-local" name="date1" value="" size=30/></p>
        <p><label> Right timeborder</label> <input class = "ggg" type="datetime-local" name="date2" value="" size=30/></p>
        <p><label> Letter combination</label> <input class = "ggg" type="text" name="name" value="" size=25/></p>
      </fieldset>
      <p><center><input class="button" type="submit" name="button" value="Send"></center></p>
    </form>

    <?php
      function Search($path, $date_left, $date_right, $name, $count)
      {
        if ($dh = opendir($path))
        {
          while (($file = readdir($dh)) !== false)
          {
            $temp = filectime($path.'\\'.$file) + 10800;
            if($file == '.' || $file == '..') continue;
            if(is_dir($path.'\\'.$file))
              Search($path.'\\'.$file, $date_left, $date_right, $name, $count);
            else if ((strpos(basename($file), $name) !== false)
              && (($temp > $date_left) && ($temp < $date_right)))
              {
                echo $path.'\\'.basename($file);
                echo "<br/>";
                $count++;
              }
          }
          closedir($dh);
        }
        return $count;
      }

      if (isset($_POST['button']))
      {
        $path = ($_POST['path']);
        $date_left = strtotime(($_POST['date1']));
        $date_right = strtotime(($_POST['date2']));
        $name = ($_POST['name']);
        $count = 0;
        if (($path == "") || ($name == "") || ((is_dir($path) === false)))
          echo "Incorrect data for search! Check it, please!";
        else
        {
          $count = Search($path, $date_left, $date_right, $name, $count);
          if ($count == 0)
            echo "Nothng has been founded!";
        }
      }

     ?>

  </body>
</html>
