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
}