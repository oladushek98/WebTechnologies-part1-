<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Laba5</title>
  </head>
  <body>
    <form class="webform" action="lab5.php" method="post">
      <input type="email" name="email" value="">
      <input type="submit" name="button" value="send">
    </form>
  </body>
</html>


<?php

  if (isset($_POST['button']))
  {
    $email = ($_POST['email']);
    if (preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $email))
    {
      $link = mysqli_connect('HOST_NAME', 'USER_NAME', 'PSW', 'DB_NAME');
      if (!$link)
        die ("Error!");
      else
      {
        echo "Connected";
        echo "<br/>";
        echo "<br/>";
        echo "<br/>";
      }

      $new_email = $_POST['email'];
      $query = "SELECT email FROM data";
      $result = mysqli_query($link, $query);
      $temp = mysqli_num_rows($result);
      $arr = [];
      $i = 0;

      if ($result)
      {
        while ($row = mysqli_fetch_row($result))
        {
          printf("%s", $row[0]); echo "<br/>";
          $arr[$i] = $row[0];
          $i++;
        }
        mysqli_free_result($result);
      }

      $count = 0;
      for ($i = 0; $i < $temp; $i++)
      {
        if ($new_email == $arr[$i])
          $count++;
      }

      if ($count == 0)
      {
        mysqli_query($link, "INSERT into TABLE_NAME(id, email) values(null, '$new_email')");
      }

      mysqli_close($link);
    }
    else
    {
      echo "Incorrect data!";
    }
  }

 ?>
