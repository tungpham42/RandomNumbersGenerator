<!DOCTYPE html>
<html>
  <head>
    <title>Random Numbers Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css" integrity="sha512-oc9+XSs1H243/FRN9Rw62Fn8EtxjEYWHXRvjS43YtueEewbS6ObfXcJNyohjHqVKFPoXXUxwc+q1K7Dee6vv9g==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/spacelab/bootstrap.min.css" integrity="sha384-F1AY0h4TrtJ8OCUQYOzhcFzUTxSOxuaaJ4BeagvyQL8N9mE4hrXjdDsNx249NpEc" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.16/clipboard.min.js" integrity="sha512-PQjdQpfbDgaFZB6gkTUjigJ4nzFvykUn3rjyTMSsWUOVzCh7wmBtWRKTA7rvCjgU5Sn8GWrobKZckvHXDOBMIA==" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="jumbotron text-center">
      <h1>Random Numbers Generator</h1>
    </div>
    <div class="container py-5">
      <div class="form-group">
        <div class="toast-header"><h2>Range</h2></div>
        <div class="row">
          <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mt-4">
            <label for="min">Min</label>
            <input class="form-control form-control-lg" id="min" name="min" value="<?php echo (isset($_POST['min'])) ? $_POST['min']: '1'; ?>" />
          </div>
          <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mt-4">
            <label for="max">Max</label>
            <input class="form-control form-control-lg" id="max" name="max" value="<?php echo (isset($_POST['max'])) ? $_POST['max']: '42'; ?>" />
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="toast-header"><h2>How Many?</h2></div>
        <div class="row">
          <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mt-4">
            <label for="quantity">Quantity</label>
            <input class="form-control form-control-lg" id="quantity" name="quantity" value="<?php echo (isset($_POST['quantity'])) ? $_POST['quantity']: '5'; ?>" />
          </div>
          <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mt-4">
            <label for="divider">Divider</label>
            <input class="form-control form-control-lg" id="divider" name="divider" value="<?php echo (isset($_POST['divider'])) ? $_POST['divider']: ', '; ?>" />
          </div>
        </div>
      <div class="form-group">
        <div class="toast-header"><h2>More options</h2></div>
        <div class="row">
          <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mt-4">
            <label for="allow_dup">Allow duplicates?</label>
            <select class="form-control form-control-lg custom-select" id="allow_dup" name="allow_dup" style="height: 48px;">
              <option <?php echo (isset($_POST['allow_dup']) && $_POST['allow_dup'] == 'no') ? 'selected': ''; ?> value="no">No</option>
              <option <?php echo (isset($_POST['allow_dup']) && $_POST['allow_dup'] == 'yes') ? 'selected': ''; ?> value="yes">Yes</option>
            </select>
          </div>
          <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mt-4">
            <label for="sort">Sort</label>
            <select class="form-control form-control-lg custom-select" id="sort" name="sort" style="height: 48px;">
              <option <?php echo (isset($_POST['sort']) && $_POST['sort'] == 'asc') ? 'selected': ''; ?> value="asc">Lowest to Highest</option>
              <option <?php echo (isset($_POST['sort']) && $_POST['sort'] == 'desc') ? 'selected': ''; ?> value="desc">Highest to Lowest</option>
              <option <?php echo (isset($_POST['sort']) && $_POST['sort'] == 'none') ? 'selected': ''; ?> value="none">Do not sort</option>
            </select>
          </div>
        </div>
      </div>
      <div id="results">
      </div>
      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mt-4">
          <button type="button" class="btn btn-lg btn-secondary btn-block" onclick="doClear();"><i class="fas fa-trash-alt"></i> Clear</button>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mt-4">
          <button type="button" name="calculate" class="btn btn-lg btn-primary btn-block" onclick="doCalculate();"><span class="spinner-grow spinner-grow-sm position-absolute d-none" role="status" aria-hidden="true" style="top: 1rem; left: auto; right: calc(50% + 3.6rem);"></span><i class="fas fa-calculator"></i> Calculate</button>
        </div>
      </div>
    </div>
    <script>
    $(document).ajaxStart(function() {
      if (!$('span[role="status"]').hasClass('d-inline-block') && $('span[role="status"]').hasClass('d-none')) {
        $('span[role="status"]').removeClass('d-none').addClass('d-inline-block');
      }
    }).ajaxStop(function() {
      if ($('span[role="status"]').hasClass('d-inline-block') && !$('span[role="status"]').hasClass('d-none')) {
        $('span[role="status"]').removeClass('d-inline-block').addClass('d-none');
      }
    })
    function doCalculate() {
      $.ajax({
        url: "results.php",
        method: "POST",
        data: {
          min : $('#min').val(),
          max : $('#max').val(),
          quantity : $('#quantity').val(),
          divider : $('#divider').val().replace(" ", "&nbsp;"),
          allow_dup : $('#allow_dup').val(),
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
    (function(){
      new Clipboard('#copy-button');
    })();
    </script>
  </body>
</html>