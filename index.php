<!DOCTYPE html>
<html>
  <head>
    <title>Random Numbers Generator</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css" integrity="sha512-oc9+XSs1H243/FRN9Rw62Fn8EtxjEYWHXRvjS43YtueEewbS6ObfXcJNyohjHqVKFPoXXUxwc+q1K7Dee6vv9g==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="container py-5">
      <h1>Random Numbers Generator</h1>
      <div class="form-group">
        <h2>Range</h2>
        <label for="min">Min</label>
        <input class="form-control form-control-lg" id="min" name="min" value="<?php echo (isset($_POST['min'])) ? $_POST['min']: '1'; ?>" />
        <label for="max">Max</label>
        <input class="form-control form-control-lg" id="max" name="max" value="<?php echo (isset($_POST['max'])) ? $_POST['max']: '42'; ?>" />
      </div>
      <div class="form-group">
        <h2>How Many?</h2>
        <label for="quantity">Quantity</label>
        <input class="form-control form-control-lg" id="quantity" name="quantity" value="<?php echo (isset($_POST['quantity'])) ? $_POST['quantity']: '5'; ?>" />
        <label for="sort">Sort</label>
        <select class="form-control form-control-lg custom-select" id="sort" name="sort">
          <option <?php echo (isset($_POST['sort']) && $_POST['sort'] == 'asc') ? 'selected': ''; ?> value="asc">Lowest to Highest</option>
          <option <?php echo (isset($_POST['sort']) && $_POST['sort'] == 'desc') ? 'selected': ''; ?> value="desc">Highest to Lowest</option>
          <option <?php echo (isset($_POST['sort']) && $_POST['sort'] == 'none') ? 'selected': ''; ?> value="none">Do not sort</option>
        </select>
      </div>
      <div class="btn-group" role="group">
        <button type="button" class="btn btn-lg btn-secondary" onclick="doClear();">Clear</button>
        <button type="button" name="calculate" class="btn btn-lg btn-primary" onclick="doCalculate();">Calculate</button>
      </div>
    </div>
    <div id="results">
    </div>
    <script>
    function doCalculate() {
      $.ajax({
        url: "results.php",
        method: "POST",
        data: {
          min : $('#min').val(),
          max : $('#max').val(),
          quantity : $('#quantity').val(),
          sort : $('#sort').val(),
        },
        dataType: "html"
      }).done(function(results){
        $('#results').html(results);
      });
    }
    function doClear() {
      $('#results').html('');
    }
    </script>
  </body>
</html>