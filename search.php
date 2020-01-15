<?php

require('config.php');
require('classes/SearchResultsProvider.php');
require('classes/ImageResultsProvider.php');

if (isset($_GET['term'])) {
  $term = $_GET['term'];
} else {
  exit("You must enter a search term");
}

$type = isset($_GET['type']) ? $_GET["type"] : "sites";
$page = isset($_GET['page']) ? $_GET["page"] : 1;

?>

<?php require('inc/header.php'); ?>
<div class="wrapper">

  <header class="search-page-header">
    <div class="container">
      <div class="header-content">

        <div class="logo">
          <a href="index.php">
            <img src="assets/img/logo.png" alt="Doodle">
          </a>
        </div>

        <div class="search-container">
          <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">

            <div class="search-bar-container">
              <input type="hidden" name="type" value="<?php echo $type; ?>">
              <input type="text" name="term" class="search-box" value="<?php echo $term; ?>" required>
              <button class="search-btn"><i class="fas fa-search"></i></button>
            </div>

          </form>
        </div>

      </div>
    </div>

    <div class="tabs-container">
      <ul class="tab-list">

        <li class="<?php echo $type == 'sites' ? 'active' : ''; ?>">
          <a href="<?php echo "search.php?term=$term&type=sites"; ?>">Sites</a>
        </li>

        <li class="<?php echo $type == 'images' ? 'active' : ''; ?>">
          <a href="<?php echo "search.php?term=$term&type=images"; ?>">Images</a>
        </li>

      </ul>
    </div>

  </header>

  <section class="search-results">
    <?php

    if ($type == "sites") {
      $resultsProvider = new SearchResultsProvider($con);

      $pageSize = 20;
    } else {
      $resultsProvider = new ImageResultsProvider($con);

      $pageSize = 30;
    }

    $numResults = $resultsProvider->getNumResults($term);

    echo "<p class='results-count'>$numResults results found.</p>";

    echo $resultsProvider->getResultsHTML($page, $pageSize, $term);

    ?>
  </section>

  <nav class="pagination">
    <div class="page-btns">

      <div class="page-number-container">
        <img src="assets/img/pageStart.png" alt="D">
      </div>

      <?php

      $pagesToShow = 10;
      $numPages = ceil($numResults / $pageSize);
      $pagesLeft = min($pagesToShow, $numPages);
      $currentPage = $page - floor($pagesToShow / 2);

      if ($currentPage < 1) {
        $currentPage = 1;
      }

      if ($currentPage + $pagesLeft > $numPages + 1) {
        $currentPage = $numPages + 1 - $pagesLeft;
      }

      if ($pagesLeft == 0 && $currentPage == 1) {
        echo "
        <div class='page-number-container'>
          <img src='assets/img/pageSelected.png'>
          
        </div>
        <div class='page-number-container'>
          <img src='assets/img/page.png'>
          
        </div>
        ";
      } else if ($pagesLeft == 1 && $currentPage == 1) {
        echo "
        <div class='page-number-container'>
          <img src='assets/img/pageSelected.png'>
          
        </div>";
      }

      while ($pagesLeft != 0 && $currentPage <= $numPages) {

        if ($currentPage == $page) {
          echo "
          <div class='page-number-container'>
            <img src='assets/img/pageSelected.png'>
            <span class='page-number'>$currentPage</span>
          </div>";
        } else {
          echo "
          <div class='page-number-container'>
            <a href='search.php?term=$term&type=$type&page=$currentPage'>
              <img src='assets/img/page.png'>
              <span class='page-number'>$currentPage</span>
            </a>
          </div>";
        }


        $currentPage++;
        $pagesLeft--;
      }


      ?>

      <div class="page-number-container">
        <img src="assets/img/pageEnd.png" alt="D, L, and E.">
      </div>

    </div>
  </nav>

</div>
<?php require('inc/footer.php'); ?>