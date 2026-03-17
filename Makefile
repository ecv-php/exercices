.PHONY: up down logs shell mysql clean

# Démarrer le projet
up:
	docker compose up -d

# Arrêter le projet
down:
	docker compose down

# Voir les logs
logs:
	docker compose logs -f

# Ouvrir un terminal dans le container PHP
shell:
	docker compose exec php bash

# Accéder à MySQL en ligne de commande
mysql:
	docker compose exec mysql mysql -uecv -pecv ecv

# Tout supprimer (remet la base de données à zéro)
clean:
	docker compose down -v
