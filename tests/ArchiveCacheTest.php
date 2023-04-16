<?php

declare(strict_types=1);

namespace Tests;

use App\Services\Cache\ArchiveCache;

//Como é igual ao MemoryCache na teoria to testando a implementação já que eles são basicamente iguais
class ArchiveCacheTest extends TestCase
{
  public function testGetCacheExists(): void
  {
    $archiveCacheClass = new ArchiveCache();
    $archiveCacheClass->setCache('POST-https://jsonplaceholder.typicode.com/postsw', 'teste-Willian');
    $response = $archiveCacheClass->getCache('GET-https://jsonplaceholder.typicode.com/postsw');
    $this->assertEquals('teste-Willian', $response);
  }

  public function testGetCacheNotExists(): void
  {
    $archiveCacheClass = new ArchiveCache();
    $response = $archiveCacheClass->getCache('GET-https://jsonplaceholder.typicode.com/postss');
    $this->assertNull($response);
  }

  public function testSetCache(): void
  {
    $archiveCacheClass = new ArchiveCache();
    $archiveCacheClass->setCache('POST-https://jsonplaceholder.typicode.com/postsw', 'teste-Willian');
    $this->assertFileExists(__DIR__ . '/../files/POST-https://jsonplaceholder.typicode.com/postsw');
  }

  public function testCheckIfCacheExistsTrue(): void
  {
    $archiveCacheClass = new ArchiveCache();
    $response = $archiveCacheClass->checkIfCacheExists('GET-https://jsonplaceholder.typicode.com/posts');
    $this->assertTrue($response);
  }

  public function testCheckIfCacheExistsFalse(): void
  {
    $archiveCacheClass = new ArchiveCache();
    $response = $archiveCacheClass->checkIfCacheExists('GET-https://jsonplaceholder.typicode.com/postss');
    $this->assertFalse($response);
  }
}
