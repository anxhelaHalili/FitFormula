<?php  if (count($errors) > 0) : ?>
  <div class="error">
    <?php foreach ($errors as $error) : ?>
      <p style="color: #eeb76b;text-shadow: 2px 2px 8px #e2a652; margin:15px"><?php echo $error ?></p>
    <?php endforeach ?>
  </div>
<?php  endif ?>