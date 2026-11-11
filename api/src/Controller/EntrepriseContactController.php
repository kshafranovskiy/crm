<?php

namespace App\Controller;

use App\Entity\Entreprise;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class EntrepriseContactController extends AbstractController
{
  #[Route('/api/entreprises/{id}/contacts', name: 'api_entreprises_contacts', methods: ['GET'])]
  public function listContacts(Entreprise $entreprise): JsonResponse
  {
    return $this->json(
      $entreprise->getContacts(),
      200,
      [],
      ['groups' => ['contact:read']]
    );
  }
}
