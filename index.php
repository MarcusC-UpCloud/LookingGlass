<?php
// lazy config check/load
if (file_exists('LookingGlass/Config.php')) {
  require 'LookingGlass/Config.php';
  if (!isset($ipv4, $ipv6, $siteName, $siteUrl, $serverLocation, $testFiles, $theme)) {
    exit('Configuration variable/s missing. Please run configure.sh');
  }
} else {
  exit('Config.php does not exist. Please run configure.sh');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $siteName; ?> - Looking Glass</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="LookingGlass - Open source PHP looking glass">
    <meta name="author" content="Telephone">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&family=Syne:wght@400;700;800&display=swap" rel="stylesheet">
    <link href="assets/css/marcusc.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">

      <!-- Header -->
      <header class="header nohighlight" id="overview">
        <div class="row">
          <div class="span12">
            <p class="eyebrow">Network Diagnostics</p>
            <h1><a href="<?php echo $siteUrl; ?>">Looking <span>Glass</span></a></h1>
            <p class="header-sub"><?php echo $siteName; ?></p>
          </div>
        </div>
      </header>

      <!-- Network Information -->
      <section id="information">
        <div class="row">
          <div class="span12">
            <div class="well">
              <span id="legend">Network Information</span>
              <p>Location: <b><?php echo $serverLocation; ?></b></p>
              <p>IPv4: <?php echo $ipv4; ?></p>
              <?php if (!empty($ipv6)) { echo '<p>IPv6: ' . $ipv6 . '</p>'; } ?>
              <p>Test files:&nbsp;
                <?php foreach ($testFiles as $val) {
                  echo "<a href=\"{$val}.test\" id=\"testfile\">{$val}</a> ";
                } ?>
              </p>
              <p>Your IP: <b><a href="#tests" id="userip"><?php echo $_SERVER['REMOTE_ADDR']; ?></a></b></p>
            </div>
          </div>
        </div>
      </section>

      <!-- Network Tests -->
      <section id="tests">
        <div class="row">
          <div class="span12">
            <form class="well form-inline" id="networktest" action="#results" method="post">
              <fieldset>
                <span id="legend">Network Tests</span>
                <div id="hosterror" class="control-group">
                  <div class="controls">
                    <input id="host" name="host" type="text" class="input-large" placeholder="Host or IP address">
                  </div>
                </div>
                <select name="cmd" class="input-medium">
                  <option value="host">host</option>
                  <option value="mtr">mtr</option>
                  <?php if (!empty($ipv6)) { echo '<option value="mtr6">mtr6</option>'; } ?>
                  <option value="ping" selected="selected">ping</option>
                  <?php if (!empty($ipv6)) { echo '<option value="ping6">ping6</option>'; } ?>
                  <option value="traceroute">traceroute</option>
                  <?php if (!empty($ipv6)) { echo '<option value="traceroute6">traceroute6</option>'; } ?>
                </select>
                <button type="submit" id="submit" name="submit" class="btn btn-primary">Run Test</button>
              </fieldset>
            </form>
          </div>
        </div>
      </section>

      <!-- Results -->
      <section id="results" style="display:none">
        <div class="row">
          <div class="span12">
            <div class="well">
              <span id="legend">Results</span>
              <pre id="response" style="display:none"></pre>
            </div>
          </div>
        </div>
      </section>

      <!-- Footer -->
      <footer class="footer nohighlight">
        <p>Powered by <a href="http://github.com/telephone/LookingGlass">LookingGlass</a></p>
        <p class="pull-right"><a href="#">Back to top</a></p>
      </footer>

    </div>

    <script src="assets/js/jquery-1.11.2.min.js"></script>
    <script src="assets/js/LookingGlass.min.js"></script>
    <script src="assets/js/XMLHttpRequest.min.js"></script>
  </body>
</html>
