<html>
<head>
  <title>Text manager</title>
  <link rel="stylesheet" href="https://unpkg.com/mustard-ui@latest/dist/css/mustard-ui.min.css">
</head>
<body>

  <header style="height: 200px;">
    <h1>Text manager</h1>
  </header>
  <br>
  <?php
  $url = $_POST["url"];
  $search = $_POST["search"];
  $keywords = preg_split('/\s+/', $search);

  $text = file_get_contents($url, true);

  function count_words($word) {
    $count = 0;
    $lastPos = 0;
    global $text;
    while (($lastPos = strpos($text, $word, $lastPos))!== false) {
      $lastPos = $lastPos + strlen($word);
      $count++;
    }
    return $count;
  }
   ?>
  <div class="row">
    <div class="col col-sm-5">
      <div class="panel">
        <div class="panel-body">

          <div class="col-md-12">
            <form action="index.php" method="post">
              <h1>Get Text</h1>
              <div class="col col-md-6">
                <input type="text" name="url" value="<?php echo $url ?>">
              </div>
              <div class="col col-md-4">
                <button class="button-primary-outlined button-round" type="submit">Fetch text</button>
              </div>

              <h1>Find Keywords</h1>
              <div class="col col-md-6">
                <input type="text" name="search" value="">
              </div>
              <div class="col col-md-4">
                <button class="button-primary-outlined button-round" type="submit">Search text</button>
              </div>
            </form>
          </div>

          <div class="col col-md-12">
            <?php
            if (isset($_POST["search"])) {
              echo "<h1>Check Results</h1>";
              echo "<div class=\"stepper\">";
              foreach ($keywords as $key => $keyword) {
                echo "<div class=\"step\">";
                echo "<p class=\"step-number\">" . count_words($keyword) . "</p>";
                echo "<p class=\"step-title\">Keyword: $keyword</p>";
                echo "</div>";
                $lastPos = 0;
                $i = 1;
                echo "<div class=\"col col-md-12\">";
                while (($lastPos = strpos($text, $keyword, $lastPos))!== false) {
                  echo "<a href=\"#$lastPos\">$i</a> ";
                  $i++;
                  $text = substr_replace($text, "<mark id=\"$lastPos\">", $lastPos, 0);
                  $lastPos = $lastPos + strlen($keyword) + 12 + strlen($lastPos);
                  $text = substr_replace($text, "</mark>", $lastPos, 0);
                  $lastPos = $lastPos + 7;
                }
                echo "</div>";
              }
              echo "</div>";
            }
           ?>
          </div>

        </div>
      </div>
    </div>

    <div class="col col-sm-7" style="padding-left: 25px;">
      <pre><code>
        <?php



        echo $text;

        ?>
      </code></pre>
    </div>
  </div>

</body>
</html>
