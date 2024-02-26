<?php 
  $pageTitle = 'Home';
  require_once('../../private/initialize.php');
  require_once('../../private/shared/publicHeader.php');
?>
  
    <body>
      <h1>Apply to be a Vendor</h1>
      <section>
        <form id="vendor-info" action="process-form.php" method="post">
          <caption>Vendor Information</caption>
          <label for="ven-name">*Name of Business:</label>
          <input type="text" name="ven-name" id="ven-name" required><br>

          <label for="ven-description">Please enter a description of your business.<small>(300-500 characters maximum)</small></label><br>
          <textarea name="ven-description" id="ven-description" maxlength="500" cols="50" rows="5"></textarea><br> 

          <label for="street">*Address</label>
          <input type="text" name="street" id="street" required><br>

          <label for="city">*City</label>
          <input type="text" name="city" id="city" required><br>

          <label for="state">*State</label>
          <input type="text" name="state" id="state" required><br>

          <input type="submit" value="Apply">
        </form>
      </section>

    </body>
  </div>
</html>
