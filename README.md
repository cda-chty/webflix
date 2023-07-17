# Webflix

Voici le projet Laravel.

## Installation

La première étape du projet pour travailler dessus, c'est de cloner le dépôt :

```bash
git clone ...
```

Il faut installer les dépendances :

```bash
composer install
```

Il faut ensuite copier le fichier `.env.example` :

```bash
# Crée le fichier .env
php -r "file_exists('.env') || copy('.env.example', '.env');"
```

N'oublions pas de générer la clé :

```bash
php artisan key:generate
```

Pour la base de données, on a les migrations :

```bash
php artisan migrate
```

## Outils

Si on veut lister les routes de l'application :

```bash
php artisan route:list
```

Pour remplir la BDD, on peut faire :

```bash
# Ajoute les données
php artisan db:seed
# Vide la base
php artisan migrate:fresh --seed
```

N'oubliez pas la clé API dans le `.env` :

```bash
THEMOVIEDB_API_KEY=???
```
