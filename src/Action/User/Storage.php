<?php

namespace Dialogflow\Action\User;

class Storage
{
  /** @var null|object */
  protected $data;

  /**
   * @param object $storage request object
   */
  public function __construct($storage)
  {
    if ($storage && $storage->data) {
      $this->data = $storage->data;
    } else {
      $this->data = new \StdClass();
    }
  }

  public function __get($name)
  {
    if (property_exists($this->data, $name)) {
      return $this->data->$name;
    }
    return null;
  }

  public function __set($name, $value)
  {
    $this->data->$name = $value;
  }

  public function clear()
  {
    $this->data = new \StdClass();
  }

  public function render()
  {
    return json_encode(['data' => $this->data ]);
  }
}