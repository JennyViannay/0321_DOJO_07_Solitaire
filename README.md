# Solitaire

Le but de ce dojo est de recrée le [jeu du solitaire](https://fr.wikipedia.org/wiki/Solitaire_(casse-t%C3%AAte)).

Lance un serveur PHP. Tu constates que l'interface graphique est déjà créée, mais pas la logique du déplacement des pions.

Ton but est donc de rendre le jeu jouable. Pour cela, tu dois modifier le contenu de la méthode `play()` (pas sa signature) dans le fichier *Game.php* (tu peux si tu le souhaites créer des méthodes supplémentaires, mais tu ne dois pas toucher aux autres méthodes déjà présentes dans la classe).

De plus, tu ne dois **modifier aucun autre fichier**.

Pour t'aider, tu peux lancer une suite de tests (`php vendor/bin/phpunit --colors=auto test`). Attention à respecter exactement les messages d'erreurs si tu veux que tous les tests passent.

Le plateau de jeu est représenté par un tableau à 2 dimensions et est considéré comme un carré. Chaque case est accessible par des coordonnées x et y. Les cases peuvent avoir 3 status : **invalid** (les "cases" du carré qui n'existe pas réélement sur le plateau de jeu, comme la case de coordonnées 0,0) ; **empty** si la case n'a pas de pion ; **pawn** si la case contient un pion. La partie commence avec une case vide au centre du plateau.

Pour déplacer un pion, il faut cliquer une première fois sur le pion de départ (from) puis sur la position désirée (to). Un message d'erreur doit s'afficher pour toute tentative de déplacement impossible.

Bon courage ! 