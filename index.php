<?php
// Liste automatiquement les exercices et leurs fichiers PHP
// Deux modes : ?source=chemin/fichier.php affiche le code source brut

if (isset($_GET['source'])) {
    $file = $_GET['source'];
    // Sécurité : on n'autorise que certaines extensions dans les dossiers exercice-*
    $real = realpath(__DIR__ . '/' . $file);
    $allowedExt = ['.php', '.sql', '.json'];
    $extOk = false;
    foreach ($allowedExt as $ext) {
        if (str_ends_with($real ?: '', $ext)) { $extOk = true; break; }
    }
    if (
        $real !== false
        && str_starts_with($real, __DIR__ . '/exercice-')
        && $extOk
    ) {
        header('Content-Type: text/plain; charset=utf-8');
        readfile($real);
    } else {
        http_response_code(403);
        echo 'Accès refusé.';
    }
    exit;
}

// Récupérer les dossiers d'exercices (scan récursif)
$exercices = [];
foreach (glob(__DIR__ . '/exercice-*', GLOB_ONLYDIR) as $dir) {
    $name = basename($dir);
    $allFiles = [];

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS)
    );
    foreach ($iterator as $fileInfo) {
        $ext = $fileInfo->getExtension();
        if (!in_array($ext, ['php', 'sql', 'json'], true)) continue;
        $relative = substr($fileInfo->getPathname(), strlen($dir) + 1);
        // Exclure vendor/ et fichiers cachés
        if (str_starts_with($relative, 'vendor/') || str_starts_with($relative, '.')) continue;
        $allFiles[] = $relative;
    }

    sort($allFiles);
    $exercices[$name] = $allFiles;
}
uksort($exercices, 'strnatcmp');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP & MySQL - Exercices</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/github.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: -apple-system, system-ui, 'Segoe UI', sans-serif; max-width: 900px; margin: 0 auto; padding: 20px; color: #1e293b; line-height: 1.6; }
        h1 { color: #1a365d; margin-bottom: 8px; }
        .info { background: #f0f4ff; padding: 12px 16px; border-radius: 8px; margin-bottom: 24px; font-size: 0.9em; color: #475569; }
        .info code { background: #e2e8f0; padding: 1px 5px; border-radius: 3px; }

        .exercice { background: #fff; border: 1px solid #e2e8f0; border-radius: 10px; margin-bottom: 16px; overflow: hidden; }
        .exercice h2 { font-size: 1em; padding: 12px 16px; background: #f8fafc; border-bottom: 1px solid #e2e8f0; color: #334155; }
        .file-list { list-style: none; }
        .file-list li { display: flex; align-items: center; justify-content: space-between; padding: 10px 16px; border-bottom: 1px solid #f1f5f9; }
        .file-list li:last-child { border-bottom: none; }
        .file-name { font-family: 'Fira Code', 'SF Mono', monospace; font-size: 0.9em; color: #334155; }
        .links { display: flex; gap: 8px; }
        .links a { font-size: 0.8em; padding: 4px 10px; border-radius: 5px; text-decoration: none; font-weight: 500; }
        .btn-run { background: #2563eb; color: #fff; }
        .btn-run:hover { background: #1d4ed8; }
        .btn-code { background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }
        .btn-code:hover { background: #e2e8f0; }

        .tools { margin-top: 24px; }
        .tools h2 { font-size: 1em; color: #334155; margin-bottom: 8px; }
        .tools a { display: inline-block; margin-right: 12px; color: #2563eb; text-decoration: none; font-size: 0.9em; }
        .tools a:hover { text-decoration: underline; }

        /* Modal pour le code source */
        .overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 100; justify-content: center; align-items: center; }
        .overlay.active { display: flex; }
        .modal { background: #fff; border-radius: 12px; width: 90%; max-width: 800px; max-height: 85vh; display: flex; flex-direction: column; box-shadow: 0 20px 60px rgba(0,0,0,0.3); }
        .modal-header { display: flex; justify-content: space-between; align-items: center; padding: 12px 16px; border-bottom: 1px solid #e2e8f0; }
        .modal-header h3 { font-size: 0.95em; font-family: monospace; color: #334155; }
        .modal-close { background: none; border: none; font-size: 1.4em; cursor: pointer; color: #94a3b8; padding: 0 4px; }
        .modal-close:hover { color: #1e293b; }
        .modal-body { overflow: auto; padding: 0; }
        .modal-body pre { margin: 0; padding: 16px; font-size: 0.85em; }
    </style>
</head>
<body>

<h1>PHP & MySQL - Exercices</h1>

<div class="info">
    <strong>PHP <?= PHP_VERSION ?></strong> sur <strong><?= PHP_OS ?></strong>
    &mdash; Serveur : <code><?= $_SERVER['SERVER_SOFTWARE'] ?? 'N/A' ?></code>
</div>

<?php foreach ($exercices as $folder => $files): ?>
    <div class="exercice">
        <h2><?= htmlspecialchars($folder) ?></h2>
        <ul class="file-list">
            <?php
            // Déterminer le point d'entrée pour "Voir le rendu"
            $hasPublicIndex = in_array('public/index.php', $files, true);
            if ($hasPublicIndex): ?>
                <li>
                    <span class="file-name" style="font-style: italic; color: #2563eb;">public/index.php (point d'entrée)</span>
                    <span class="links">
                        <a class="btn-run" href="<?= htmlspecialchars($folder . '/public/index.php') ?>" target="_blank">Voir le rendu</a>
                    </span>
                </li>
            <?php endif; ?>
            <?php foreach ($files as $file): ?>
                <li>
                    <span class="file-name"><?= htmlspecialchars($file) ?></span>
                    <span class="links">
                        <a class="btn-code" href="#" onclick="showSource('<?= htmlspecialchars($folder . '/' . $file, ENT_QUOTES) ?>'); return false;">Voir le code</a>
                        <?php if (str_ends_with($file, '.php') && !str_contains($file, '/') && !$hasPublicIndex): ?>
                            <a class="btn-run" href="<?= htmlspecialchars($folder . '/' . $file) ?>" target="_blank">Voir le rendu</a>
                        <?php endif; ?>
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endforeach; ?>

<div class="tools">
    <h2>Outils</h2>
    <a href="http://localhost:8082" target="_blank">phpMyAdmin (port 8082)</a>
    <a href="http://localhost:8083" target="_blank">Adminer (port 8083)</a>
</div>

<!-- Modal code source -->
<div class="overlay" id="overlay" onclick="closeModal(event)">
    <div class="modal">
        <div class="modal-header">
            <h3 id="modal-title">fichier.php</h3>
            <button class="modal-close" onclick="closeModal()">&times;</button>
        </div>
        <div class="modal-body">
            <pre><code id="modal-code" class="language-php"></code></pre>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/php.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/php-template.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/sql.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/json.min.js"></script>
<script>
function showSource(file) {
    document.getElementById('modal-title').textContent = file;
    var container = document.getElementById('modal-code');
    container.textContent = 'Chargement...';
    container.className = file.endsWith('.sql') ? 'language-sql' : file.endsWith('.json') ? 'language-json' : 'language-php-template';
    container.removeAttribute('data-highlighted');
    document.getElementById('overlay').classList.add('active');

    fetch('?source=' + encodeURIComponent(file))
        .then(function(r) { return r.text(); })
        .then(function(code) {
            container.textContent = code;
            hljs.highlightElement(container);
        });
}

function closeModal(e) {
    if (!e || e.target === document.getElementById('overlay')) {
        document.getElementById('overlay').classList.remove('active');
    }
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeModal();
});
</script>

</body>
</html>
