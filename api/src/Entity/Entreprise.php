<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  private ?string $raisonSociale = null;

  #[ORM\Column(length: 9, unique: true, nullable: true)]
  private ?string $siren = null;

  #[ORM\Column(length: 255, nullable: true)]
  private ?string $secteurActivite = null;

  #[ORM\Column(length: 255, nullable: true)]
  private ?string $ville = null;

  #[ORM\Column(length: 255, nullable: true)]
  private ?string $siteWeb = null;

  /**
   * @var Collection<int, Contact>
   */
  #[ORM\OneToMany(targetEntity: Contact::class, mappedBy: 'entreprise')]
  private Collection $contacts;

  public function __construct()
  {
    $this->contacts = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getRaisonSociale(): ?string
  {
    return $this->raisonSociale;
  }

  public function setRaisonSociale(string $raisonSociale): static
  {
    $this->raisonSociale = $raisonSociale;

    return $this;
  }

  public function getSiren(): ?string
  {
    return $this->siren;
  }

  public function setSiren(?string $siren): static
  {
    $this->siren = $siren;

    return $this;
  }

  public function getSecteurActivite(): ?string
  {
    return $this->secteurActivite;
  }

  public function setSecteurActivite(?string $secteurActivite): static
  {
    $this->secteurActivite = $secteurActivite;

    return $this;
  }

  public function getVille(): ?string
  {
    return $this->ville;
  }

  public function setVille(?string $ville): static
  {
    $this->ville = $ville;

    return $this;
  }

  public function getSiteWeb(): ?string
  {
    return $this->siteWeb;
  }

  public function setSiteWeb(?string $siteWeb): static
  {
    $this->siteWeb = $siteWeb;

    return $this;
  }

  /**
   * @return Collection<int, Contact>
   */
  public function getContacts(): Collection
  {
    return $this->contacts;
  }

  public function addContact(Contact $contact): static
  {
    if (!$this->contacts->contains($contact)) {
      $this->contacts->add($contact);
      $contact->setEntreprise($this);
    }

    return $this;
  }

  public function removeContact(Contact $contact): static
  {
    if ($this->contacts->removeElement($contact)) {
      // set the owning side to null (unless already changed)
      if ($contact->getEntreprise() === $this) {
        $contact->setEntreprise(null);
      }
    }

    return $this;
  }
}
