<!-- if we have messages in session -->
<?php if(!empty($sessionMessages)) : ?>
    <!-- we'll read every entry -->
    <?php foreach ($sessionMessages as $key => $message) : ?>
      <!-- the css class we'll depend on the key -->
      <?php ($key === "success" ? $class="alert-success" : $class='alert-danger') ?>
      <!-- then we display the message -->
      <div class="alert <?= $class ?>"><?= $message ?></div>
    <?php endforeach ?>
  <?php endif ?>