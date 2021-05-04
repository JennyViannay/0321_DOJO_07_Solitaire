<?php
session_start();

use App\Game;

require '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('../src/View');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
    'debug' => true,
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());
if(!empty($_GET['reset'])) {
    session_destroy();
    header('Location: /');
}

$game = new Game($_SESSION['board'] ?? null);

if (!empty($_GET['coord']) && !empty($_SESSION['from']) && empty($_SESSION['to'])) {
    $_SESSION['to'] = explode(',', $_GET['coord']);
}
if (!empty($_GET['coord']) && empty($_SESSION['from'])) {
    $_SESSION['from'] = explode(',', $_GET['coord']);
}

if (!empty($_SESSION['from']) && !empty($_SESSION['to'])) {
    try {
        $game->play($_SESSION['from'], $_SESSION['to']);
    } catch(LogicException $e) {
        $error = $e->getMessage();
    } finally {
        $_SESSION['from'] = $_SESSION['to'] = null;
    }
    $_SESSION['board'] = $game->getBoard();
}

echo $twig->render('index.html.twig', [
    'board' => $game->getBoard(),
    'from' => $_SESSION['from'] ?? null,
    'to' => $_SESSION['to'] ?? null,
    'error' => $error ?? '',
]);
