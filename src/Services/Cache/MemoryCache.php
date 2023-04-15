<?php

declare(strict_types=1);

namespace App\Services\Cache;

use App\Interfaces\LocalCache;

class MemoryCache implements LocalCache
{
  private $server;

  public function __construct()
  {
    $server = new Memcached();
    $server->addServer("127.0.0.1", 11211);
  }

  public function getCache(string $key): mixed
  {
    return $this->server->get($key);
  }

  public function setCache(string $key, mixed $value)
  {
    if(!class_exists('Memcache')){
      return;
    }
    $this->server->setCache($key, $value, false, 3600);
  }

  public function checkIfCacheExists(string $key): bool
  {
    if(!class_exists('Memcache')){
      return false;
    }
    $this->server->get($key);

    return $this->server->getResultCode();
  }
}
