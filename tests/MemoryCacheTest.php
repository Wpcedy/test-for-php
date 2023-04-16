<?php

declare(strict_types=1);

namespace Tests;

use App\Services\Cache\MemoryCache;

//Como é igual ao ArchiveCache na teoria to testando a implementação já que eles são basicamente iguais
class MemoryCacheTest extends TestCase
{
  public function testGetCacheExists(): void
  {
    $memoryCacheClass = new MemoryCache();
    $memoryCacheClass->setCache('POST-https://jsonplaceholder.typicode.com/postsw', 'teste-Willian');
    $response = $memoryCacheClass->getCache('GET-https://jsonplaceholder.typicode.com/postsw');
    $this->assertEquals('teste-Willian', $response);
  }

  public function testGetCacheNotExists(): void
  {
    $memoryCacheClass = new MemoryCache();
    $response = $memoryCacheClass->getCache('GET-https://jsonplaceholder.typicode.com/postss');
    $this->assertNull($response);
  }

  public function testSetCache(): void
  {
    $memoryCacheClass = new MemoryCache();
    $memoryCacheClass->setCache('POST-https://jsonplaceholder.typicode.com/postsw', 'teste-Willian');
    $this->assertFileExists(__DIR__ . '/../files/POST-https://jsonplaceholder.typicode.com/postsw');
  }

  public function testCheckIfCacheExistsTrue(): void
  {
    $memoryCacheClass = new MemoryCache();
    $response = $memoryCacheClass->checkIfCacheExists('GET-https://jsonplaceholder.typicode.com/posts');
    $this->assertTrue($response);
  }

  public function testCheckIfCacheExistsFalse(): void
  {
    $memoryCacheClass = new MemoryCache();
    $response = $memoryCacheClass->checkIfCacheExists('GET-https://jsonplaceholder.typicode.com/postss');
    $this->assertFalse($response);
  }
}