<?php

namespace App\Factory;

use App\Entity\Entreprise;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
 * @extends PersistentObjectFactory<Entreprise>
 */
final class EntrepriseFactory extends PersistentObjectFactory
{
  /**
   * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
   *
   * @todo inject services if required
   */
  public function __construct()
  {
  }

  #[\Override]
  public static function class(): string
  {
    return Entreprise::class;
  }

  /**
   * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
   *
   * @todo add your default values here
   */
  #[\Override]
  protected function defaults(): array|callable
  {
    return [
      'raisonSociale' => self::faker()->company(),
      'siren' => self::faker()->unique()->numerify('#########'),
      'secteurActivite' => self::faker()->optional()->jobTitle(),
      'ville' => self::faker()->city(),
      'siteWeb' => self::faker()->optional(0.5)->url(),
    ];
  }

  /**
   * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
   */
  #[\Override]
  protected function initialize(): static
  {
    return $this// ->afterInstantiate(function(Entreprise $entreprise): void {})
      ;
  }
}
