<?php
// Exercice 7 : Formulaire de contact complet
// Pattern "sticky form" + validation + protection XSS + CSRF

declare(strict_types=1);
session_start();

// Fonction d'échappement XSS
function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

// Génération du token CSRF
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Validation du formulaire
function validateContactForm(array $data): array
{
    $errors = [];

    if (empty($data['name'])) {
        $errors['name'] = 'Le nom est requis';
    } elseif (mb_strlen($data['name']) < 2) {
        $errors['name'] = 'Nom trop court (min 2 car.)';
    }

    if (empty($data['email'])) {
        $errors['email'] = 'L\'email est requis';
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email invalide';
    }

    if (empty($data['subject'])) {
        $errors['subject'] = 'Le sujet est requis';
    }

    if (empty($data['message'])) {
        $errors['message'] = 'Le message est requis';
    } elseif (mb_strlen($data['message']) < 20) {
        $errors['message'] = 'Message trop court (min 20 car.)';
    }

    return $errors;
}

// Traitement du formulaire
$errors = [];
$success = false;
$formData = ['name' => '', 'email' => '', 'subject' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification CSRF
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'] ?? '')) {
        die('Token CSRF invalide');
    }

    // Récupération et nettoyage
    $formData = [
        'name' => trim($_POST['name'] ?? ''),
        'email' => trim($_POST['email'] ?? ''),
        'subject' => trim($_POST['subject'] ?? ''),
        'message' => trim($_POST['message'] ?? ''),
    ];

    $errors = validateContactForm($formData);

    if (empty($errors)) {
        $success = true;
        $formData = array_fill_keys(array_keys($formData), ''); // Reset
        // Régénérer le token CSRF après soumission réussie
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact — Exercice 7</title>
    <style>
        body { font-family: system-ui, sans-serif; max-width: 600px; margin: 2rem auto; padding: 0 1rem; }
        h1 { color: #333; }
        label { display: block; margin-top: 1rem; font-weight: bold; }
        input, textarea { width: 100%; padding: 0.5rem; margin-top: 0.25rem; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        textarea { resize: vertical; }
        input.invalid, textarea.invalid { border-color: #e53e3e; }
        .error { color: #e53e3e; font-size: 0.875rem; margin-top: 0.25rem; }
        .success { color: #2f855a; padding: 1rem; background: #e8f5e9; border-radius: 4px; margin-bottom: 1rem; }
        button { margin-top: 1.5rem; padding: 0.75rem 2rem; background: #3182ce; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 1rem; }
        button:hover { background: #2c5282; }
    </style>
</head>
<body>
    <h1>Contactez-nous</h1>

    <?php if ($success): ?>
        <div class="success">Votre message a été envoyé avec succès !</div>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
        <div style="color: #e53e3e; margin-bottom: 1rem;">
            <p>Veuillez corriger les erreurs ci-dessous :</p>
        </div>
    <?php endif; ?>

    <form method="POST" novalidate>
        <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token']) ?>">

        <label for="name">Nom *</label>
        <input type="text" id="name" name="name"
               value="<?= e($formData['name']) ?>"
               class="<?= isset($errors['name']) ? 'invalid' : '' ?>">
        <?php if (isset($errors['name'])): ?>
            <div class="error"><?= e($errors['name']) ?></div>
        <?php endif; ?>

        <label for="email">Email *</label>
        <input type="email" id="email" name="email"
               value="<?= e($formData['email']) ?>"
               class="<?= isset($errors['email']) ? 'invalid' : '' ?>">
        <?php if (isset($errors['email'])): ?>
            <div class="error"><?= e($errors['email']) ?></div>
        <?php endif; ?>

        <label for="subject">Sujet *</label>
        <input type="text" id="subject" name="subject"
               value="<?= e($formData['subject']) ?>"
               class="<?= isset($errors['subject']) ? 'invalid' : '' ?>">
        <?php if (isset($errors['subject'])): ?>
            <div class="error"><?= e($errors['subject']) ?></div>
        <?php endif; ?>

        <label for="message">Message * <small>(min 20 caractères)</small></label>
        <textarea id="message" name="message" rows="6"
                  class="<?= isset($errors['message']) ? 'invalid' : '' ?>"><?= e($formData['message']) ?></textarea>
        <?php if (isset($errors['message'])): ?>
            <div class="error"><?= e($errors['message']) ?></div>
        <?php endif; ?>

        <button type="submit">Envoyer</button>
    </form>
</body>
</html>
