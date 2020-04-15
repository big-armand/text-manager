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
  $url = $_POST[url];
  $search = $_POST[search];
  $keywords = preg_split('/\s+/', $search);

  $text = file_get_contents($url, true);
   ?>
  <div class="row">
    <div class="col col-sm-5">
      <div class="panel">
        <div class="panel-body">

          <div class="col-md-12">
            <form action="index.php" method="post">
              <h1>Get Text</h1>
              <div class="col col-md-6">
                <input type="text" name="url" value="">
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

        </div>
      </div>
    </div>

    <div class="col col-sm-7" style="padding-left: 25px;">
      <pre><code>
        <?php

        foreach ($keywords as $key => $keyword) {
          substr_replace($keyword, "<br>$keyword<br>", 0);
        }

        echo $text;

        ?>
      </code></pre>
    </div>
  </div>

</body>
</html>
