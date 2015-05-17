private static $kt;

public static function kt() {
  return self::$kt;
}

public static function kirby($vars) {
  $data = array();
  foreach(page()->content()->data() as $key => $value) {
    $data[$key] = $value->toString();
  }
  foreach($vars as $key => $value) {
    if ($value === self::$kt) {
      $value = page()->content()->get($key)->kirbytext();
    }
    else if (is_callable($value)) {
      $value = array_map($value, page()->content()->get($key)->yaml());
    }  
    $data[$key] = $value;
  }

  echo self::ref('/' . page()->intendedTemplate() . '.tl', $data);
}
