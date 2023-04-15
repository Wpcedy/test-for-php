<?php

declare(strict_types=1);

namespace App\Services\Cache;

use App\Interfaces\LocalCache;

use function file_get_contents;

class ArchiveCache implements LocalCache
{
  public function getCache(string $key): mixed
  {
    if (file_exists(__DIR__.'/../../../files'.$key)) {
      return file_get_contents(__DIR__.'/../../../files'.$key);
    }
  }

  public function setCache(string $key, mixed $value)
  {
    $fp     =   fopen(__DIR__.'/../../../files'.$key, 'w');
    fwrite($fp, $value);
    fclose($fp);
    ob_end_flush();
  }

  public function checkIfCacheExists(string $key): bool
  {
    if (file_exists(__DIR__.'/../../../files'.$key)) {
      return true;
    }
    return false;
  }
}
