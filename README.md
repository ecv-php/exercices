# Exercices PHP & MySQL

## Prérequis

- [Docker Desktop](https://www.docker.com/products/docker-desktop/) ou Docker Engine installé et lancé

C'est tout ! Pas besoin d'installer PHP, MySQL ou quoi que ce soit d'autre.

## Démarrage rapide

Ouvrez un terminal dans ce dossier, puis :

**macOS / Linux :**
```bash
make up
```

**Windows (PowerShell ou CMD) :**
```bash
docker compose up -d
```

Ouvrez ensuite [http://localhost:8080](http://localhost:8080) dans votre navigateur.

## Commandes disponibles

| Action                        | macOS / Linux | Windows (PowerShell)        |
|-------------------------------|---------------|-----------------------------|
| Lancer le projet              | `make up`     | `docker compose up -d`     |
| Arrêter le projet             | `make down`   | `docker compose down`      |
| Voir les logs                 | `make logs`   | `docker compose logs -f`   |
| Terminal dans le container PHP| `make shell`  | `docker compose exec php bash` |
| Accéder à MySQL               | `make mysql`  | `docker compose exec mysql mysql -uecv -pecv ecv` |
| Tout supprimer (reset BDD)    | `make clean`  | `docker compose down -v`   |

## Accès

| Service     | URL                                      |
|-------------|------------------------------------------|
| Exercices   | [localhost:8080](http://localhost:8080)   |
| phpMyAdmin  | [localhost:8082](http://localhost:8082)   |
| Adminer     | [localhost:8083](http://localhost:8083)   |

## Structure des fichiers

```
exercices/
  exercice-0/    Premier exercice (phpinfo)
  exercice-1/    Variables, HTML + PHP
  exercice-2/    Opérateurs, calculs
  exercice-3/    Superglobales, paramètres URL
  ...
  index.php      Page d'accueil (liste tous les exercices)
```

Chaque exercice est un simple fichier `.php` que vous pouvez modifier avec votre éditeur de code. Les changements sont visibles immédiatement en rafraîchissant la page.

## Identifiants MySQL

- Hôte : `mysql`
- Base : `ecv`
- Utilisateur : `ecv`
- Mot de passe : `ecv`

## Configuration avancée (optionnel)

Le dossier `docker/advanced/` contient une configuration Docker plus complète avec :

- Plusieurs versions de PHP (5.6, 7.4, 8.5)
- PostgreSQL en plus de MySQL
- Nginx **et** Caddy comme serveurs web

Pour la lancer :

```bash
docker compose -f docker/advanced/compose.yaml up -d
```

| Version PHP | Nginx (port) | Caddy (port) |
|-------------|-------------|--------------|
| PHP 5.6     | [localhost:8056](http://localhost:8056) | [localhost:8156](http://localhost:8156) |
| PHP 7.4     | [localhost:8074](http://localhost:8074) | [localhost:8174](http://localhost:8174) |
| PHP 8.5     | [localhost:8085](http://localhost:8085) | [localhost:8185](http://localhost:8185) |
