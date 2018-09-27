<?php

namespace App\Service;
use Predis\Client;

class RedisService{
  private $client;

  public function __construct($redis_url){
    $this->client = new Client($redis_url);
  }
  public function getClient(){
    return $this->client;
  }
}