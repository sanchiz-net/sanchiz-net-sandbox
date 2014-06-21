<?php
if (isset($_POST['submit']) ) : ?>
  <?php
    include('classSimpleImage.php');
    $image = new SimpleImage();
    $image->load($_FILES['uploaded_image']['tmp_name']);
    $image->resizeToWidth(150);
    $image->output();
  ?>
<?php else : ?>
  ?>
  <form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="uploaded_image" />
    <input type="submit" name="submit" value="Upload" />
  </form>
<?php endif; ?>
