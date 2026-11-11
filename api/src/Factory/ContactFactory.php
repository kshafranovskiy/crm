<?php

namespace App\Factory;

use App\Entity\Contact;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
 * @extends PersistentObjectFactory<Contact>
 */
final class ContactFactory extends PersistentObjectFactory
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
    return Contact::class;
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
      'entreprise' => EntrepriseFactory::new(),
      'nom' => self::faker()->lastName(),
      'prenom' => self::faker()->firstName(),
      'fonction' => self::faker()->optional()->jobTitle(),
      'email' => self::faker()->email(),
      'telephone' => self::faker()->optional(0.5)->phoneNumber(),
    ];
  }

  /**
   * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
   */
  #[\Override]
  protected function initialize(): static
  {
    return $this// ->afterInstantiate(function(Contact $contact): void {})
      ;
  }
}
