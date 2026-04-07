<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Catalogue SF' ?></title>
    <style>
        body { font-family: system-ui, sans-serif; max-width: 800px; margin: 2rem auto; padding: 0 1rem; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { padding: 0.5rem; border: 1px solid #ddd; text-align: left; }
        th { background: #f5f5f5; }
        tr:hover { background: #fafafa; }
        nav { background: #f5f5f5; padding: 0.75rem 1rem; border-radius: 8px; margin-bottom: 1.5rem; }
        nav a { margin-right: 1rem; text-decoration: none; color: #2563eb; }
        nav a:hover { text-decoration: underline; }
        form div { margin-bottom: 1rem; }
        label { display: block; font-weight: bold; margin-bottom: 0.25rem; }
        input, select { padding: 0.4rem; width: 100%; max-width: 400px; }
        button { padding: 0.5rem 1.5rem; background: #2563eb; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #1d4ed8; }
    </style>
</head>
<body>
    <nav>
        <a href="index.php?page=movies">Films</a>
        <a href="index.php?page=movies&action=create">Ajouter</a>
    </nav>

    <main><?= $content ?></main>

    <footer style="margin-top: 2rem; padding-top: 1rem; border-top: 1px solid #ddd; color: #666; font-size: 0.875rem;">
        Exercice 11 — Architecture MVC
    </footer>
</body>
</html>
