<?php
error_reporting(-1);
ini_set('display_errors', 'On');
sleep(1);
if (isset($_POST['min']) && isset($_POST['max']) && isset($_POST['quantity']) && isset($_POST['divider']) && isset($_POST['allow_dup']) && isset($_POST['sort'])) {
  $results_array = array();
  $results = '';
  $min = $_POST['min'];
  $max = $_POST['max'];
  $quantity = $_POST['quantity'];
  $divider = str_replace(' ', '&nbsp;', $_POST['divider']);
  $allow_dup = $_POST['allow_dup'];
  $sort = $_POST['sort'];
  $has_error = false;
  while ((count($results_array) < $quantity) && ((($max - $min + 1) >= $quantity) || $allow_dup == 'yes')) {
    array_push($results_array, rand($min, $max));
    if ($allow_dup == 'no') {
      $results_array = array_unique($results_array);
    }
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
  $results = implode($divider, $results_array);
?>
    <div class="jumbotron mt-4 mx-0 mb-0">
      <div class="container">
<?php
if ((($max - $min + 1) >= $quantity) || $allow_dup == 'yes'):
?>
        <div id="results-text" class="display-4 text-primary text-wrap text-break"><?php echo $results; ?></div>
        <button type="button" class="btn btn-primary btn-sm float-right" id="copy-button" data-clipboard-target="#results-text"><i class="fas fa-copy"></i> Copy</button>
<?php
elseif ((($max - $min + 1) < $quantity) || $allow_dup == 'no'):
?>
        <div class="lead text-danger text-wrap text-break">Cannot generate more numbers than exist in the range or you can set Allow duplicates to Yes.</div>
<?
endif;
?>
      </div>
    </div>
<?php
}
?>