<?php require('inc/header.php'); ?>

<div class="wrapper index-page">
  <section id="main">

    <div class="logo">
      <img src="assets/img/logo.png" alt="Doodle">
    </div>

    <div class="search-container">
      <form method="GET" action="search.php">
        <input type="text" name="term" class="search-box" required>
        <input type="submit" value="Search" class="search-btn">
      </form>
    </div>

  </section>
</div>


<?php require('inc/footer.php'); ?>