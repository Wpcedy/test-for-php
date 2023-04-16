<?php

declare(strict_types=1);

namespace App\Services;

require(__DIR__ . '/../config.php');

class CacheService
{
  public $cacheHandler;

  //Poderia receber uma das implementações do cache local no construct porém achei melhor por config nesse modelo de teste
  public function __construct()
  {
    $config = include(__DIR__ . '/src/config.php');
    $cacheClass = $config['LocalCache'];

    $this->cacheHandler = new $cacheClass();
  }

  public function getCache(string $key): mixed
  {
    return $response = $this->cacheHandler->getCache($key);
  }
  public function setCache(string $key, mixed $value)
  {
    return  $this->cacheHandler->setCache($key, $value);
  }
  public function checkIfCacheExists(string $key): bool
  {
    return $this->cacheHandler->checkIfCacheExists($key);
  }
}
