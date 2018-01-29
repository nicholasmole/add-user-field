<?php

namespace Mole\AUF;

class Helpers {

  //Returns Template path for emails : Thx James
  public static function get_template_path($template_filename) {

    $templates_path = plugin_dir_path(dirname(__FILE__)) . "templates";
    $template_path = "$templates_path/$template_filename";
    return $template_path;

  }

}