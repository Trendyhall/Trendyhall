<form method="post" action="">
   <div class="mb-3 form-check">
    <input name="checkbox" type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check to set data</label>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Table name</label>
    <input name="tablename" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Column name</label>
    <input name="columnname" type="text" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Value</label>
    <input name="value" type="text" class="form-control" id="exampleInputPassword1">
  </div>
  <button type="submit" class="btn btn-primary mb-3">Submit</button>
</form class="mb-3">
<p >DATA:</p>
<p><?php echo $resulte ?></p>