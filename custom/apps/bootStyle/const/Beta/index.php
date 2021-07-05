<?php
namespace index;
defined('BASEPATH') or exit('No direct script access allowed');

class header {
  const HEADER = 
}

?>
<div class="header" id="myHeader">
  <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Projekti</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
        <?php if ($_SESSION['tab'] == 1): ?>
          <li class="nav-item active">
          <?php else: ?>
            <li class="nav-item">
            <?php endif; ?>
            <a class="nav-link" href="https://www.spletniprojekti.eu/project/">Domov</a>
          </li>
          <?php if ($_SESSION['tab'] == 2): ?>
            <li class="nav-item active">
            <?php else: ?>
              <li class="nav-item">
              <?php endif; ?>
              <a class="nav-link" href="https://www.spletniprojekti.eu/project/sites/win.php">WINDOWS 10</a>
            </li>
            <?php if ($_SESSION['tab'] == 3): ?>
              <li class="nav-item active">
              <?php else: ?>
                <li class="nav-item">
                <?php endif; ?>
                <a class="nav-link" href="https://www.spletniprojekti.eu/project/linux.php">Linux</a>
              </li>
            </ul>
          </div>
        </nav>

</div>
