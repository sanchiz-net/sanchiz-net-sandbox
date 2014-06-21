<?php

class SimpleImage {

  /**
   * @var image
   */
  public $image;

  /**
   * @var string image_type
   */
  public $image_type;

  /**
   * Load image from file.
   */
  public function load($filename) {
    $image_info = getimagesize($filename);
    $this->image_type = $image_info[2];
    if ($this->image_type == IMAGETYPE_JPEG) {
      $this->image = imagecreatefromjpeg($filename);
    }
    elseif ($this->image_type == IMAGETYPE_GIF) {
      $this->image = imagecreatefromgif($filename);
    }
    elseif ($this->image_type == IMAGETYPE_PNG) {
      $this->image = imagecreatefrompng($filename);
    }
  }

  /**
   * Save image to file.
   */
  public function save(
    $filename,
    $image_type = IMAGETYPE_JPEG,
    $compression = 75,
    $permissions = NULL
  ) {
    if ($image_type == IMAGETYPE_JPEG) {
      imagejpeg($this->image, $filename, $compression);
    }
    elseif ($image_type == IMAGETYPE_GIF) {
      imagegif($this->image, $filename);
    }
    elseif ($image_type == IMAGETYPE_PNG) {
      imagepng($this->image, $filename);
    }
    if ($permissions != NULL) {
      chmod($filename, $permissions);
    }
  }

  /**
   * Output image to browser.
   */
  public function output($image_type = IMAGETYPE_JPEG) {
    if ($image_type == IMAGETYPE_JPEG) {
      imagejpeg($this->image);
    }
    elseif ($image_type == IMAGETYPE_GIF) {
      imagegif($this->image);
    }
    elseif ($image_type == IMAGETYPE_PNG) {
      imagepng($this->image);
    }
  }

  /**
   * Performs resizing to certain height.
   */
  public function resizeToHeight($height) {
    $ratio = $height / $this->getHeight();
    $width = $this->getWidth() * $ratio;
    $this->resize($width, $height);
  }

  /**
   * Returns image height.
   */
  public function getHeight() {
    return imagesy($this->image);
  }

  /**
   * Returns image width.
   */
  public function getWidth() {
    return imagesx($this->image);
  }

  /**
   * Perform resizing to certain width and height.
   */
  public function resize($width, $height) {
    $new_image = imagecreatetruecolor($width, $height);
    imagecopyresampled(
      $new_image,
      $this->image,
      0,
      0,
      0,
      0,
      $width,
      $height,
      $this->getWidth(),
      $this->getHeight()
    );
    $this->image = $new_image;
  }

  /**
   * Performs resizing to certain width.
   */
  public function resizeToWidth($width) {
    $ratio = $width / $this->getWidth();
    $height = $this->getheight() * $ratio;
    $this->resize($width, $height);
  }

  /**
   * Scale image with coefficient.
   */
  public function scale($scale) {
    $width = $this->getWidth() * $scale / 100;
    $height = $this->getheight() * $scale / 100;
    $this->resize($width, $height);
  }
}

