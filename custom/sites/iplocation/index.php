<?php
define('BASEPATH', true);

include "../../Modules/dotEnv/dotEnv.php";
include "../../Modules/ip/ip.php";
?>
<!DOCTYPE html>
<html lang="si" dir="ltr">
  <head>
    <meta charset="utf-8">
    <?php include 'inc/header.php'; ?>
    <title>Ip location</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col">
          <center>
            <h4>Write ip address</h4><br>
            Your current IP address is displayed in the form below
            <form class="input" action="" method="POST">
              <div class="search-box">
                <input class="" type="text" autocomplete="off" placeholder="<?= $_SERVER['REMOTE_ADDR'] ?>" name="api" value="<?= $_SERVER['REMOTE_ADDR'] ?>"/> <br><br>
                <input class="btn btn-primary" type="submit" name="form" value="Show me data from ip address" />
              </div>
            </form>
          </center>
        </div>
      </div>
      <?php if (isset($_POST['form'])):

        $iplocation = new iplocation($_POST['api']);?>
        <?php if ($iplocation->lookIp()['country'] == null): ?>
          <h1>Trenutno aplikacija ni na voljo, se opravičujem za nevšečnosti 😩.<br> Kmalu spet na voljo 😉.</h1>
        <?php else: ?>
        <div class="row">
          <ul>
            <li>Ip adrress: <span style="color:blue; font-size: 20px;"><?= $iplocation->lookIp()['ip'] ?></span></li>
            <li>Country:    <?= $iplocation->lookIp()['country'] ?></li>
            <li>City:       <?= $iplocation->lookIp()['city'] ?></li>
          </ul>
        </div>
        <h4 style="color:black">Lokacija na zemljevidu je prikazana približno, zaradi zaščite osebnih podatkov.</h4>
        <p></p>
        <div id="map" class="map kenburns-top"></div>
        <script type="text/javascript">
          var map = new ol.Map({
            target: 'map',
            layers: [
              new ol.layer.Tile({
                source: new ol.source.OSM()
              })
            ],
            view: new ol.View({
              center: ol.proj.fromLonLat([<?= $iplocation->lookIp()['longitude'] ?>, <?= $iplocation->lookIp()['latitude'] ?>]),
              zoom: 15
            })
          });
        </script>
      </div>
    <?php endif; ?>
      <?php endif; ?>
    </div>
    <div class="row">
      <div class="container">
        <?php include 'inc/footer.php'; ?>
        <?php include 'inc/manual.php'; ?>
        <?php include 'inc/pogoji.php'; ?>
      </div>
    </div>
  </body>
</html>
