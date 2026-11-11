<?php

namespace App\Story;

use App\Factory\ContactFactory;
use App\Factory\EntrepriseFactory;
use Zenstruck\Foundry\Attribute\AsFixture;
use Zenstruck\Foundry\Story;

#[AsFixture(name: 'main')]
final class AppStory extends Story
{
    public function build(): void
    {
        EntrepriseFactory::createMany(30);
        ContactFactory::createMany(60, fn() => ['entreprise' => EntrepriseFactory::random()]);
    }
}
