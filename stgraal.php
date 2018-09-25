<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Mon test</title>
        <link rel="stylesheet" href="reset.css">
        <link rel="stylesheet" href="jquery-ui.css">
        <link rel="stylesheet" href="stylesg.css">
        <link rel="stylesheet" href="style.css">
        <script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
        <script src="js/jquery-ui.js"></script>
        <script src="js/executeJQ.js"></script>
    </head>

    <body>
        <div class="global">
            <header class="banner">
                <h1 id="titrebanner">Les Flex Box et Transitions</h1>
                <a id="menuOff" href="#" class="hide-toggle"></span>Menu Off</a>
                <nav class="mainmenu">
                    Ici la barre de menu
                </nav>
            </header>
            <div class="master">
                <main class="main">
                    <?php
					include 'card.php';
                    ?>
                </main>
                <nav class="sidebar1">
                    <a href="#" class="left-toggle"><span class="ui-icon ui-icon-caret-1-w"></span></a>
                    <a href="#" class="right-toggle"><span class="ui-icon ui-icon-caret-1-e"></span></a>                    
                    <a href="#" class="nosidebar-toggle"><span class="ui-icon ui-icon-caret-1-s"></span></a>
                    <h1>Menu</h1>
                    
                    <ul>
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li>
                            <a href="/">Premier lien</a>
                        </li>
                        <li>
                            <a href="/infoFormation.php">Formulaire</a>
                        </li>
                        <li>
                            <a href="/contact">Contacter nous</a>
                        </li>
                    </ul>
                </nav>
                <nav class="sidebar2">
                    <h1>Menu 2</h1>
                    <ul>
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li>
                            <a href="/">Premier lien</a>
                        </li>
                        <li>
                            <a href="http://formation/infoFormation.php">2 lien</a>
                        </li>
                        <li>
                            <a href="/contact">Contacter nous</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <footer class="footer">
                <p>
                    &copy; Copyright  by Pierre Vanlierde
                </p>
            </footer>
        </div>
    </body>
</html>
