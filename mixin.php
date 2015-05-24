private static $kt;

public static function kt() {
  return static::$kt;
}

public static function kirby($vars) {
  $data = array();
  foreach(page()->content()->data() as $key => $value) {
    $data[$key] = $value->toString();
  }
  foreach($vars as $key => $value) {
    if ($value === static::$kt) {
      $value = page()->content()->get($key)->kirbytext();
    }
    else if (is_callable($value)) {
      $value = array_map($value, page()->content()->get($key)->yaml());
    }
    $data[$key] = $value;
  }
  $ref = '/' . page()->intendedTemplate() . '.tl';
  if (static::resolve($ref)) {
    echo static::ref($ref, $data);
  }
  else {
    echo static::ref('/' . page()->template() . '.tl', $data);
  }
}
