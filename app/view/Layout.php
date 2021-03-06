<!doctype html>
<html lang="pt-br">
    <head>
        <!--Meta obrigatorio -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Wanclei Felipe">
        <meta name="description" content="<?= $this->getDescription(); ?>">
        <meta name="keywords" content="<?= $this->getKeywords(); ?>">
        <title><?= $this->getTitle(); ?></title>

        <!-- Estilos em cascata @CSS-->
        <link rel="icon" type="image/png" href="<?= DIRPAGE . '/public/template/Login_v17/images/icons/favicon.ico' ?>"/>
        <link rel="stylesheet" href="<?= DIRCSS . 'bootstrap-3.3.7/dist/css/bootstrap.min.css' ?>">
        <link rel="stylesheet" href="<?= DIRCSS . 'bootstrap-3.3.7/dist/css/bootstrap-theme.min.css' ?>">        
        <link rel="stylesheet" href="<?= DIRCSS . 'main.css' ?>">
        <link rel="stylesheet" href="<?= DIRCSS . 'Footer-white.css' ?>">

        <?= $this->addHead(); ?>
    </head>
    <body>
        <?php
        $url = $_GET['url'];
        if ($url != '') {
            if ($url != 'login') {
                require(DIRREQ . '/config/navbar.php');
            }
        }
        ?>
        <!-- Menu, Navbars etc..-->
        <div class="Header">
            <?= $this->addHeader(); ?>
        </div>


        <!-- Conteudo -->

        <div class="Main">
            <?= $this->addMain(); ?>
        </div> 


        <!-- Rodapé -->

        
            <footer id="myFooter">
        <div class="container">
            <hr>
            <ul>
                <li><a href="#">Desenvolvimento</a></li>
                <li><a href="#">Contato</a></li>
                <li><a href="#">Suporte</a></li>
                <li><a href="#">Github</a></li>
            </ul>
        <p class="footer-copyright"> 2019 Copyright - Wanclei Felipe</p>
        </div>  
    </footer>
        

        <!-- SCRIPTS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>        
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="https://www.google.com/recaptcha/api.js?render=<?= SITEKEY ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.quicksearch/2.3.1/jquery.quicksearch.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.min.js"></script>
        <script src="<?= DIRCSS . 'bootstrap-3.3.7/dist/js/bootstrap.min.js' ?>"></script>
        <script src="<?= DIRJS . 'modernizr-2.8.3-respond-1.4.2.min.js' ?>"></script>
        <script src="<?= DIRJS . 'zepto.min.js' ?>"></script>
        <script src="<?= DIRJS . 'main.js' ?>"></script>      
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function (b, o, i, l, e, r) {
                b.GoogleAnalyticsObject = l;
                b[l] || (b[l] =
                        function () {
                            (b[l].q = b[l].q || []).push(arguments)
                        });
                b[l].l = +new Date;
                e = o.createElement(i);
                r = o.getElementsByTagName(i)[0];
                e.src = '//www.google-analytics.com/analytics.js';
                r.parentNode.insertBefore(e, r)
            }(window, document, 'script', 'ga'));
            ga('create', 'UA-XXXXX-X', 'auto');
            ga('send', 'pageview');
        </script>                    
    </body>
</html>

