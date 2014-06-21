<?php
// Include classSimpleImage.
include('classSimpleImage.php');

// Resize to width and height.
$image = new SimpleImage();
$image->load('image.jpg');
$image->resize(400, 200);
$image->save('image1.jpg');

// Resize to width.
$image = new SimpleImage();
$image->load('image.jpg');
$image->resizeToWidth(250);
$image->save('image1.jpg');

// Scale image.
$image = new SimpleImage();
$image->load('image.jpg');
$image->scale(50);
$image->save('image1.jpg');

// Return image to output.
header('Content-Type: image/jpeg');
$image = new SimpleImage();
$image->load('image.jpg');
$image->resizeToWidth(150);
$image->output();
