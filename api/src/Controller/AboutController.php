<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class AboutController extends AbstractController
{
  #[Route('/api/about', name: 'api_about', methods: ['GET'])]
  public function about(): JsonResponse
  {
    return $this->json(['name' => 'Ezontis CRM', 'version' => '0.1.0']);
  }
}
