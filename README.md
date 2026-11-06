# CRM

Outil de prospection et de suivi commercial : repérer une entreprise, la contacter, noter chaque échange, relancer au bon moment, envoyer un devis et facturer la mission signée.

> **Projet en cours de construction.** Pour l'instant, seule une API minimale existe. Les fonctionnalités ci-dessous arrivent module par module, voir [Avancement](#avancement).

## Fonctionnalités prévues

- Fiches entreprises et contacts, avec l'historique des échanges
- Opportunités avec montant estimé, probabilité et date de signature prévue
- Pipeline en kanban, de « à contacter » à « gagné » ou « perdu »
- Journal des échanges et relances avec date de rappel
- Devis, factures et avoirs en PDF, avec une numérotation conforme
- Email quotidien des relances et purge RGPD des prospects inactifs
- Rôles admin et commercial
- Accès aux données du CRM depuis Claude, via un serveur MCP

## Stack

| Partie | Technologies | État |
|---|---|---|
| API | PHP 8.4, Symfony 8.1, API Platform | En cours |
| Base de données | PostgreSQL (Docker), Doctrine ORM | Installés, pas encore utilisés |
| Front | React, TypeScript, Vite | Prévu |
| Serveur MCP | Rust | Prévu |

## Structure du dépôt

```text
crm/
└── api/    API Symfony
```

`front/` et `mcp/` seront ajoutés dans ce même dépôt.

## Installation

Prérequis : PHP 8.4 ou plus, Composer et la [Symfony CLI](https://symfony.com/download).

```bash
git clone https://github.com/kshafranovskiy/crm.git
cd crm/api
composer install
symfony serve -d
```

Lance toujours `composer`, `symfony` et `php bin/console` depuis le dossier `api/`.

## Routes disponibles

| Méthode | URL | Rôle |
|---|---|---|
| `GET` | `/api/health` | Indique que l'API fonctionne |
| `GET` | `/api/about` | Renvoie le nom et la version de l'API |

```bash
curl -i http://127.0.0.1:8000/api/health
```

Le port peut être différent : `symfony serve` affiche le bon.

En développement, le profiler Symfony est accessible sur `/_profiler`.

## Avancement

### Symfony

- [x] Module 0 : premiers pas (routes `health` et `about`, profiler)
- [ ] Module 1 : Doctrine, entreprises et contacts
- [ ] Module 2 : API Platform et validation
- [ ] Module 3 : sécurité
- [ ] Module 4 : opportunités et pipeline
- [ ] Module 5 : cycle de vie avec Workflow
- [ ] Module 6 : devis et facturation conforme
- [ ] Module 7 : historique et relances
- [ ] Module 8 : tâches asynchrones et RGPD
- [ ] Module 9 : import et tests d'API

### React

- [ ] Module 10 : premiers pas
- [ ] Module 11 : brancher l'API
- [ ] Module 12 : formulaires et tests
- [ ] Module 13 : le CRM complet

### Mise en ligne

- [ ] Module 14 : déploiement

### Rust

- [ ] Module 15 : les bases et un premier serveur MCP
- [ ] Module 16 : brancher Claude sur le CRM
