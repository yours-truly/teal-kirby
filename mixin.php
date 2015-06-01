private static $kt;

public static function kt() {
  return static::$kt;
}

public static function kirby($vars = array()) {
  $data = array();

  foreach(site()->content()->data() as $key => $value) {
    $data[$key] = $data['site' . ucfirst($key)] = $value->toString();
  }

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
    echo static::render($ref, $data);
  }
  else {
    echo static::render('/' . page()->template() . '.tl', $data);
  }
}
