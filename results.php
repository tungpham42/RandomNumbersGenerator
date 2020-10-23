<?php
error_reporting(-1);
ini_set('display_errors', 'On');
if (isset($_POST['min']) && isset($_POST['max']) && isset($_POST['quantity']) && isset($_POST['sort'])) {
  $results_array = array();
  $results = '';
  $min = $_POST['min'];
  $max = $_POST['max'];
  $quantity = $_POST['quantity'];
  $sort = $_POST['sort'];
  $has_error = false;
  while ((count($results_array) < $quantity) && (($max - $min + 1) >= $quantity)) {
    array_push($results_array, rand($min, $max));
    $results_array = array_unique($results_array);
  }
  switch ($sort) {
    case 'asc':
      sort($results_array);
      break;
    case 'desc':
      rsort($results_array);
      break;
    case 'none':
      break;
  }
  $results = implode(", ",$results_array);
?>
    <div class="jumbotron m-0">
      <div class="container">
<?php
if (($max - $min + 1) >= $quantity):
?>
        <div class="display-4 text-primary"><?php echo $results; ?></div>
<?php
elseif (($max - $min + 1) < $quantity):
?>
        <div class="lead text-danger">Cannot generate more numbers than exist in the range.</div>
<?
endif;
?>
      </div>
    </div>
<?php
}
?>