<?php

declare(strict_types=1);

namespace App;

use App\Services\CacheService;

use function file_get_contents;
use function http_build_query;
use function json_decode;
use function json_encode;
use function stream_context_create;

class HttpRequest extends CacheService
{
  public function call(string $method, string $url, array $parameters = null, array $data = null): array
  {
    $methodCall = strtolower($method) . 'Method';

    $response = $this->$methodCall($method, $url, $parameters, $data);

    return json_decode($response, true);
  }

  private function getMethod(string $method, string $url, ?array $parameters, ?array $data)
  {
    $key = strtoupper($method) . '-' . $url;

    if ($this->cacheHandler->checkIfCacheExists($key)) {
      $response = $this->cacheHandler->getCache($key);
    } else {
      $response = $this->makeRequest($method, $url, $parameters, $data);

      $this->cacheHandler->setCache($key, $response);
    }

    return $response;
  }

  private function postMethod(string $method, string $url, ?array $parameters, ?array $data)
  {
    $response = $this->makeRequest($method, $url, $parameters, $data);

    return $response;
  }

  private function putMethod(string $method, string $url, ?array $parameters, ?array $data)
  {
    $key = strtoupper($method) . '-' . $url;

    if ($this->cacheHandler->checkIfCacheExists($key)) {
      $response = $this->cacheHandler->getCache($key);
    } else {
      $response = $this->makeRequest($method, $url, $parameters, $data);

      $this->cacheHandler->setCache($key, $response);
    }

    return $response;
  }

  private function deleteMethod(string $method, string $url, ?array $parameters, ?array $data)
  {
    $key = strtoupper($method) . '-' . $url;

    if ($this->cacheHandler->checkIfCacheExists($key)) {
      $response = $this->cacheHandler->getCache($key);
    } else {
      $response = $this->makeRequest($method, $url, $parameters, $data);

      $this->cacheHandler->setCache($key, $response);
    }

    return $response;
  }

  private function makeRequest(string $method, string $url, ?array $parameters, ?array $data)
  {
    $opts = [
      'http' => [
        'method'  => $method,
        'header'  => 'Content-type: application/json',
        'content' => $data ? json_encode($data) : null
      ]
    ];

    $url .= ($parameters ? '?' . http_build_query($parameters) : '');

    $response = file_get_contents($url, false, stream_context_create($opts));

    return $response;
  }
}
