<?php

namespace App\Interfaces;

interface LocalCache
{
  public function getCache(string $key): mixed;
  public function setCache(string $key, mixed $value);
  public function checkIfCacheExists(string $key): bool;
}
