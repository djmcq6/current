<?php
$currentURL = $_SERVER['REQUEST_URI'];

// Check if there are existing parameters in the URL
if (strpos($currentURL, '?') !== false) {
    // URL already contains parameters
    $currentURL .= '&form=transaction';
} else {
    // URL doesn't have any parameters yet
    $currentURL .= '?form=transaction';
}
?>
<!-- portfolionavbar.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="newportfolio1.php">Portfolio</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarPortfolio" aria-controls="navbarPortfolio" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarPortfolio">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="controlcenter.php">Control Center</a>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="<?php echo htmlspecialchars($currentURL); ?>">Transaction</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="run_bot.php">Run Bot</a>
      </li>

    </ul>
  </div>
</nav>