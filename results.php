<?php
if (isset($_POST['min']) && isset($_POST['max']) && isset($_POST['quantity']) && isset($_POST['sort'])) {
  $results_array = [];
  $results = '';
  $min = $_POST['min'];
  $max = $_POST['max'];
  $quantity = $_POST['quantity'];
  $sort = $_POST['sort'];
  for ($i = 0; $i < $quantity; ++$i) {
    $results_array[$i] = rand($min, $max);
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
    <div class="jumbotron">
      <div class="container">
        <div class="display-4"><?php echo $results; ?></div>
      </div>
    </div>
<?php
}
?>