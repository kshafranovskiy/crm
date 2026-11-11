# CRM

Outil de prospection et de suivi commercial : repérer une entreprise, la contacter, noter chaque échange, relancer au bon moment, envoyer un devis et facturer la mission signée.

> **Projet en cours de construction.** Pour l'instant, l'API gère les entreprises et leurs contacts en base, avec des données de test. Les autres fonctionnalités arrivent module par module, voir [Avancement](#avancement).

## Fonctionnalités prévues

- Fiches entreprises et contacts, avec l'historique des échanges
- Opportunités avec montant estimé, probabilité et date de signature prévue
- Pipeline en kanban, de « à contacter » à « gagné » ou « perdu »
- Journal des échanges et relances avec date de rappel
- Devis, factures et avoirs en PDF, avec une numérotation conforme
- Import d'entreprises et de contacts depuis un fichier CSV
- Échanges de fichiers par SFTP et traitements par lots la nuit
- Email quotidien des relances et purge RGPD des prospects inactifs
- Tableau de bord commercial mis à jour en temps réel
- Rôles admin et commercial
- Accès aux données du CRM depuis Claude, via un serveur MCP

## Stack

| Partie | Technologies | État |
|---|---|---|
| API | PHP 8.4, Symfony 8.1, API Platform | En cours |
| Base de données | PostgreSQL 17 (Docker), Doctrine ORM | Entreprises et contacts |
| Données de test | Foundry, Faker | 30 entreprises, 60 contacts |
| Front | React, TypeScript, Vite | Prévu |
| Serveur MCP | Rust | Prévu |

## Structure du dépôt

```text
crm/
└── api/    API Symfony
```

`front/` et `mcp/` seront ajoutés dans ce même dépôt.

## Installation

Prérequis :

- PHP 8.4 ou plus, avec les extensions `pdo_pgsql` et `pgsql` activées dans `php.ini`
- Composer
- La [Symfony CLI](https://symfony.com/download)
- Docker, pour la base PostgreSQL

```bash
git clone https://github.com/kshafranovskiy/crm.git
cd crm/api
composer install
docker compose up -d
symfony console doctrine:migrations:migrate
symfony console doctrine:fixtures:load
symfony serve -d
```

Lance toujours `composer` et `symfony` depuis le dossier `api/`.

Utilise `symfony console` plutôt que `php bin/console` : Docker expose la base sur un port choisi au hasard, et la Symfony CLI le détecte pour remplir `DATABASE_URL`.

`doctrine:fixtures:load` vide la base, puis la remplit avec des entreprises et des contacts fictifs, en français.

## Modèle de données

| Entité | Champs | Relation |
|---|---|---|
| `Entreprise` | raison sociale, SIREN (unique), secteur d'activité, ville, site web | a plusieurs contacts |
| `Contact` | nom, prénom, fonction, email, téléphone | appartient à une entreprise |

## Routes disponibles

| Méthode | URL | Rôle |
|---|---|---|
| `GET` | `/api/health` | Indique que l'API fonctionne |
| `GET` | `/api/about` | Renvoie le nom et la version de l'API |
| `GET` | `/api/entreprises/{id}/contacts` | Renvoie les contacts d'une entreprise, ou une 404 si elle n'existe pas |

```bash
curl -i http://127.0.0.1:8000/api/health
```

Le port peut être différent : `symfony serve` affiche le bon.

Les identifiants ne repartent pas de 1 après un `doctrine:fixtures:load`. Pour trouver une entreprise qui a des contacts :

```bash
symfony console dbal:run-sql "SELECT entreprise_id, COUNT(*) FROM contact GROUP BY entreprise_id"
```

En développement, le profiler Symfony est accessible sur `/_profiler`.

## Avancement

### Symfony

- [x] Module 0 : premiers pas (routes `health` et `about`, profiler)
- [x] Module 1 : Doctrine, entreprises et contacts (entités, migrations, fixtures, route des contacts)
- [ ] Module 2 : API Platform, validation, tests et CI
- [ ] Module 3 : sécurité, authentification
- [ ] Module 4 : sécurité, autorisations
- [ ] Module 5 : opportunités et pipeline
- [ ] Module 6 : sous le capot, services, requête et API externe
- [ ] Module 7 : cycle de vie avec Workflow
- [ ] Module 8 : devis et facturation conforme
- [ ] Module 9 : Twig et génération de PDF
- [ ] Module 10 : historique et relances
- [ ] Module 11 : tâches asynchrones et RGPD
- [ ] Module 12 : import CSV et recherche
- [ ] Module 13 : SFTP et batchs de nuit

### React

- [ ] Module 14 : React et TypeScript, premiers pas
- [ ] Module 15 : brancher l'API
- [ ] Module 16 : formulaires et tests de composants
- [ ] Module 17 : React en profondeur
- [ ] Module 18 : le CRM complet

### Mise en ligne

- [ ] Module 19 : serveur de production
- [ ] Module 20 : infra as code et mise en ligne
- [ ] Module 21 : cybersécurité et RGPD

### Approfondissements

- [ ] Module 22 : tests de bout en bout
- [ ] Module 23 : tableau de bord et temps réel
- [ ] Module 24 : back-office, Twig et formulaires

### Rust

- [ ] Module 25 : un serveur MCP pour Claude
