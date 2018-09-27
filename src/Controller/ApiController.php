<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ApiController extends Controller{

  /**
   * @Route("/", name="home")
   **/
  public function home(Request $request): Response{

    return $this->json(["status" => "ok"]);

  }

  /**
   * @Route("/bol/{id}", name="bol", methods={"GET"})
   **/
  public function bol(Request $request, $id):Response{
    $bol = [
      "id" => "123456-12345678-34567",
      "items" => []
    ];
    return $this->json($bol, 200);
  }

  /**
   * @Route("/bol", name="bol_create", methods={"POST"})
   **/
  public function create(Request $request):Response{
    $bol = [
      "id" => "123456-12345678-34567",
      "items" => []
    ];
    return $this->json($bol, 201);
  }

  /**
   * @Route("/bol", name="bol_additem", methods={"PUT"})
   **/
  public function addItem(Request $request):Response{
    $item = $request->request->get("item");
    $bol = [
      "id" => "123456-12345678-34567",
      "items" => []
    ];

    $bol["items"][] = $item;
    return $this->json($bol, 201);
  }

  /**
   * @Route("/bol", name="bol_clear", methods={"DELETE"})
   **/
  public function clear(Request $request):Response{
    $bol = [
      "id" => "123456-12345678-34567",
      "items" => ["pizza", "pâtes"]
    ];

    $bol["items"] = [];
    return $this->json($bol, 201);
  }

  /**
   * @Route("/bol/shake", name="bol_shake", methods={"GET"})
   **/
  public function shake(Request $request):Response{
    $bol = [
      "id" => "123456-12345678-34567",
      "items" => ["pizza", "pâtes"]
    ];

    shuffle($bol["items"]);
    return $this->json($bol, 200);
  }

  /**
   * @Route("/bol/draw", name="bol_draw", methods={"GET"})
   **/
  public function draw(Request $request):Response{
    $bol = [
      "id" => "123456-12345678-34567",
      "items" => ["pizza", "pâtes"]
    ];

    $item = array_pop($bol["items"]);
    return $this->json($item, 201);
  }

}