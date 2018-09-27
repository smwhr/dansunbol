<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Service\RedisService;
use Ramsey\Uuid\Uuid;


class ApiController extends Controller{

  private $redis = null;

  public function __construct(RedisService $redisService){
    $this->redis = $redisService->getClient();
  }

  /**
   * @Route("/", name="home")
   **/
  public function home(Request $request): Response{

    return $this->json(["status" => "ok"]);

  }

  /**
   * @Route("/bol/{uuid}", name="bol", methods={"GET"})
   **/
  public function bol(Request $request, $uuid):Response{
    $bol = json_decode($this->redis->get($uuid), true);
    return $this->json($bol, 200);
  }

  /**
   * @Route("/bol", name="bol_create", methods={"POST"})
   **/
  public function create(Request $request):Response{
    $uuid4 = Uuid::uuid4()->toString();
    $bol = [
      "id" => $uuid4,
      "items" => []
    ];
    $this->redis->set($uuid4, json_encode($bol));
    
    return $this->json($bol, 201);
  }

  /**
   * @Route("/bol/{uuid}", name="bol_additem", methods={"PUT"})
   **/
  public function addItem(Request $request, $uuid):Response{
    $item = $request->getContent();
    $bol = json_decode($this->redis->get($uuid), true);

    $bol["items"][] = $item;
    $this->redis->set($uuid4, json_encode($bol));
    return $this->json($bol, 201);
  }

  /**
   * @Route("/bol/{uuid}", name="bol_clear", methods={"DELETE"})
   **/
  public function clear(Request $request, $uuid):Response{
    $bol = json_decode($this->redis->get($uuid), true);
    $bol["items"] = [];
    $this->redis->set($uuid4, json_encode($bol));
    return $this->json($bol, 201);
  }

  /**
   * @Route("/bol/{uuid}/shake", name="bol_shake", methods={"GET"})
   **/
  public function shake(Request $request, $uuid):Response{
    $bol = json_decode($this->redis->get($uuid), true);
    shuffle($bol["items"]);
    $this->redis->set($uuid4, json_encode($bol));
    return $this->json($bol, 200);
  }

  /**
   * @Route("/bol/{uuid}/draw", name="bol_draw", methods={"GET"})
   **/
  public function draw(Request $request, $uuid):Response{
    $bol = json_decode($this->redis->get($uuid), true);
    $item = array_pop($bol["items"]);
    $this->redis->set($uuid4, json_encode($bol));
    return $this->json($item, 201);
  }

}