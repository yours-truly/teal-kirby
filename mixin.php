public static function kirby($vars = array()) {
  $data = array();

  foreach(site()->content()->data() as $key => $value) {
    $data[$key] = $data['site' . ucfirst($key)] = $value->toString();
  }

  foreach(page()->content()->data() as $key => $value) {
    $data[$key] = $value->toString();
  }

  foreach($vars as $key => $value) {
    if (is_callable($value)) {
      $value = call_user_func($value, page()->content()->get($key));
    }
    $data[$key] = $value;
  }

  $ref = '/' . page()->intendedTemplate() . '.tl';
  if (static::resolve($ref)) {
    echo tl($ref, $data);
  }
  else {
    echo tl('/' . page()->template() . '.tl', $data);
  }
}

public static function mapYaml($fn) {
  return function($value) use ($fn) {
    return array_map($fn, $value->yaml());
  };
}
