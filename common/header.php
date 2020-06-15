<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>" prefix="og: http://ogp.me/ns#">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta property="og:type" content="website">

        <?php if (isset($imageUrl)): ?>
        <meta property="og:image" content="<?php echo $imageUrl; ?>">
        <?php endif; ?>

        <?php
        $fullUrl = ($_SERVER['REQUEST_URI']);
        $trimmed = trim($fullUrl, ".php");
        $canonical = rtrim($trimmed, '/');
        $canonical = 'https://bd.centrelectura.cat' . $canonical;
        ?>
        <link rel="canonical" href="<?php echo $canonical; ?>">
        <meta property="og:url" content="<?php echo $canonical; ?>">

        <?php if (isset($description) && $description !== ''): ?>
        <meta name="description" content="<?php echo $description; ?>">
        <meta property="og:description" content="<?php echo $description; ?>">
        <?php endif; ?>

        <?php if (isset($author) && $author !== ''): ?>
        <meta name="author" content="<?php echo $author; ?>">
        <?php endif; ?>

        <?php
        if (isset($title)) {
            $titleParts[] = strip_formatting($title);
        }
        $titleParts[] = option('site_title');
        $title = implode(' &middot; ', $titleParts);
        ?>
        <meta property="og:title" content="<?php echo $title; ?>">
        <title><?php echo $title; ?></title>

        <?php // Mostramos los <link> a Feed RSS ?>
        <?php echo auto_discovery_link_tags(); ?>
		
		 <?php fire_plugin_hook('public_head',array('view'=>$this)); ?>

        <?php
        queue_css_file(array('bdcdl-2020'), 'all', false, 'css', $version = '0.3.6');
        echo head_css();
        ?>
        <script src='https://www.google.com/recaptcha/api.js' async defer></script>
        
        <?php
        queue_js_file(array('bootstrap.bundle', 'bdcdl'), 'javascripts', array(), '0.3.6');
        echo head_js();
        ?>
		<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-26370586-1', 'auto');
		ga('send', 'pageview');
		</script>
    </head>
    <?php // Si queremos pasar una clase al body ?>
    <?php echo body_tag(array('class' => @$bodyclass)); ?>
    <!--[if IE]>
    <div id="wrap" class="wrap-ie">
    <![endif]-->
    <!--[if !IE]>
    <div id="wrap" class="wrap-not-ie">
    <![endif]-->
        <!-- Navegacio -->
    <header class="position-sticky">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-top">
            <?php
            echo link_to_home_page(
                '<img height="30" src="' .
                img('cdl-escut-blanc-petit.png', 'images') .
                '" alt="Escut blanc del Centre de Lectura" class="d-inline-block align-top">' .
                '&nbsp;&nbsp;BIBLIOTECA DIGITAL',
                array('class' => 'navbar-brand')
            );
            ?>
            <button class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarToggler"
                    aria-controls="navbarToggler"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <?php
            $navLinkClass = array(
                    'home' => 'nav-link',
                'collections' => 'nav-link',
                'items' => 'nav-link',
                'tags' => 'nav-link'
            );
            if (isset($page)) {
                switch ($page) {
                    case 'home':
                        $navLinkClass['home'] = 'nav-link active';
                        break;
                    case 'collections':
                        $navLinkClass['collections'] = 'nav-link active';
                        break;
                    case 'items':
                        $navLinkClass['items'] = 'nav-link active';
                        break;
                    case 'tags':
                        $navLinkClass['tags'] = 'nav-link active';
                }
            }
            ?>
            <div class="collapse navbar-collapse" id="navbarToggler">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <?php echo link_to_home_page('INICI', array('class'=>$navLinkClass['home'])); ?>
                    </li>
                    <li class="nav-item">
                        <?php echo link_to('collections', 'browse', 'COL&middot;LECCIONS', array('class'=>$navLinkClass['collections'])); ?>
                    </li>
                    <li class="nav-item">
                        <?php echo link_to('items', 'browse', '&Iacute;TEMS', array('class'=>$navLinkClass['items'])); ?>
                    </li>
                    <li class="nav-item">
                        <?php echo link_to('items', 'tags', 'ETIQUETES', array('class'=>$navLinkClass['tags'])); ?>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="https://facebook.com/centredelectura" target="_blank">
                            <svg version="1.1"
                                 xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                 x="0px"
                                 y="0px"
                                 class="navbar-nav-svg"
                                 viewBox="0 20 266.893 266.895"
                                 xml:space="preserve">
                                <path fill="#FFFFFF" d="M182.409,262.307v-99.803h33.499l5.016-38.895h-38.515V98.777c0-11.261,3.127-18.935,19.275-18.935	l20.596-0.009V45.045c-3.562-0.474-15.788-1.533-30.012-1.533c-29.695,0-50.025,18.126-50.025,51.413v28.684h-33.585v38.895h33.585 v99.803H182.409z"/>
                            </svg>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://twitter.com/centredelectura" target="_blank">
                            <svg version="1.1"
                                 xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                 x="0px"
                                 y="0px"
                                 class="navbar-nav-svg"
                                 viewBox="50 50 300 300"
                                 xml:space="preserve">
                                <path fill="white" d="M153.6,301.6c94.3,0,145.9-78.2,145.9-145.9c0-2.2,0-4.4-0.1-6.6c10-7.2,18.7-16.3,25.6-26.6c-9.2,4.1-19.1,6.8-29.5,8.1c10.6-6.3,18.7-16.4,22.6-28.4c-9.9,5.9-20.9,10.1-32.6,12.4c-9.4-10-22.7-16.2-37.4-16.2c-28.3,0-51.3,23-51.3,51.3c0,4,0.5,7.9,1.3,11.7c-42.6-2.1-80.4-22.6-105.7-53.6c-4.4,7.6-6.9,16.4-6.9,25.8c0,17.8,9.1,33.5,22.8,42.7c-8.4-0.3-16.3-2.6-23.2-6.4c0,0.2,0,0.4,0,0.7c0,24.8,17.7,45.6,41.1,50.3c-4.3,1.2-8.8,1.8-13.5,1.8c-3.3,0-6.5-0.3-9.6-0.9c6.5,20.4,25.5,35.2,47.9,35.6c-17.6,13.8-39.7,22-63.7,22c-4.1,0-8.2-0.2-12.2-0.7C97.7,293.1,124.7,301.6,153.6,301.6"/>
                            </svg>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://instagram.com/centredelectura" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="navbar-nav-svg">
                                <path style="fill:#FFFFFF" d="M256,49.471c67.266,0,75.233.257,101.8,1.469,24.562,1.121,37.9,5.224,46.778,8.674a78.052,78.052,0,0,1,28.966,18.845,78.052,78.052,0,0,1,18.845,28.966c3.45,8.877,7.554,22.216,8.674,46.778,1.212,26.565,1.469,34.532,1.469,101.8s-0.257,75.233-1.469,101.8c-1.121,24.562-5.225,37.9-8.674,46.778a83.427,83.427,0,0,1-47.811,47.811c-8.877,3.45-22.216,7.554-46.778,8.674-26.56,1.212-34.527,1.469-101.8,1.469s-75.237-.257-101.8-1.469c-24.562-1.121-37.9-5.225-46.778-8.674a78.051,78.051,0,0,1-28.966-18.845,78.053,78.053,0,0,1-18.845-28.966c-3.45-8.877-7.554-22.216-8.674-46.778-1.212-26.564-1.469-34.532-1.469-101.8s0.257-75.233,1.469-101.8c1.121-24.562,5.224-37.9,8.674-46.778A78.052,78.052,0,0,1,78.458,78.458a78.053,78.053,0,0,1,28.966-18.845c8.877-3.45,22.216-7.554,46.778-8.674,26.565-1.212,34.532-1.469,101.8-1.469m0-45.391c-68.418,0-77,.29-103.866,1.516-26.815,1.224-45.127,5.482-61.151,11.71a123.488,123.488,0,0,0-44.62,29.057A123.488,123.488,0,0,0,17.3,90.982C11.077,107.007,6.819,125.319,5.6,152.134,4.369,179,4.079,187.582,4.079,256S4.369,333,5.6,359.866c1.224,26.815,5.482,45.127,11.71,61.151a123.489,123.489,0,0,0,29.057,44.62,123.486,123.486,0,0,0,44.62,29.057c16.025,6.228,34.337,10.486,61.151,11.71,26.87,1.226,35.449,1.516,103.866,1.516s77-.29,103.866-1.516c26.815-1.224,45.127-5.482,61.151-11.71a128.817,128.817,0,0,0,73.677-73.677c6.228-16.025,10.486-34.337,11.71-61.151,1.226-26.87,1.516-35.449,1.516-103.866s-0.29-77-1.516-103.866c-1.224-26.815-5.482-45.127-11.71-61.151a123.486,123.486,0,0,0-29.057-44.62A123.487,123.487,0,0,0,421.018,17.3C404.993,11.077,386.681,6.819,359.866,5.6,333,4.369,324.418,4.079,256,4.079h0Z"/>
                                <path style="fill:#FFFFFF" d="M256,126.635A129.365,129.365,0,1,0,385.365,256,129.365,129.365,0,0,0,256,126.635Zm0,213.338A83.973,83.973,0,1,1,339.974,256,83.974,83.974,0,0,1,256,339.973Z"/>
                                <circle style="fill:#FFFFFF" cx="390.476" cy="121.524" r="30.23"/>
                            </svg>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.youtube.com/c/CentredeLecturaReus" target="_blank">
                            <svg version="1.1"
                                xmlns:svg="http://www.w3.org/2000/svg"
                                xmlns="http://www.w3.org/2000/svg"
                                x="0px"
                                y="0px"
                                 class="navbar-nav-svg"
                                viewBox="0 0 71.412065 50"
                                xml:space="preserve">
                                <path style="fill:#ffffff;fill-opacity:1" d="M 35.705078 0 C 35.705078 0 13.35386 0.0001149 7.765625 1.4707031 C 4.765625 2.2942325 2.2942325 4.7653952 1.4707031 7.8242188 C 0.0001149 13.412454 -2.9605947e-016 25 0 25 C 0 25 0.0001149 36.64637 1.4707031 42.175781 C 2.2942325 45.234605 4.7068015 47.647174 7.765625 48.470703 C 13.412684 50.000115 35.705078 50 35.705078 50 C 35.705078 50 58.058249 49.999885 63.646484 48.529297 C 66.705308 47.705767 69.117877 45.293199 69.941406 42.234375 C 71.411994 36.64614 71.412109 25.058594 71.412109 25.058594 C 71.412109 25.058594 71.470818 13.412454 69.941406 7.8242188 C 69.117877 4.7653952 66.705308 2.3528263 63.646484 1.5292969 C 58.058249 -0.000114879 35.705078 2.9605947e-016 35.705078 0 z M 28.587891 14.294922 L 47.175781 25 L 28.587891 35.705078 L 28.587891 14.294922 z "/>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
        <div id="cookie-box" class="alert alert-info alert-dismissible" role="alert" style="margin-bottom: 0px; padding: 10px 35px 10px 15px;">
            <button type="button" id="cookie-close" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Aquesta p&agrave;gina web fa servir <i>cookies</i> pr&ograve;pies i de tercers per recollir dades estad&iacute;stiques sobre la navegaci&oacute;. Si continua navegant, considerem que n'accepta el seu &uacute;s.
            <button type="button"
                    id="cookie-ok"
                    class="btn btn-sm btn-outline-dark"
                    data-dismiss="alert">
                <svg class="bi bi-check" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 010 .708l-7 7a.5.5 0 01-.708 0l-3.5-3.5a.5.5 0 11.708-.708L6.5 10.293l6.646-6.647a.5.5 0 01.708 0z" clip-rule="evenodd"/>
                </svg>
            </button>
            <button type="button"
                    class="btn btn-sm btn-outline-dark"
                    data-toggle="collapse"
                    data-target="#cookieInfo"
                    aria-expanded="false"
                    aria-controls="cookieInfo">
                <svg class="bi bi-info" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z"/>
                    <circle cx="8" cy="4.5" r="1"/>
                </svg>
            </button>
            <div class="collapse" id="cookieInfo">
                <hr>
                <p><b>Qu&egrave; s&oacute;n les <i>cookies</i>?</b></p>
                <p>Una <i>cookie</i> &eacute;s un fitxer que es descarrega al seu ordinador quan accedeix a determinades p&agrave;gines webs. Les <i>cookies</i> permeten a una p&agrave;gina web, entre d'altres coses, emmagatzemar i recuperar informaci&oacute; sobre els h&agrave;bits de navegaci&oacute; d'un usuari o del seu equip i, en funci&oacute; de la informaci&oacute; que continguin i de la forma en que faci servir l'equip, pot utilitzar-se per a recon&egrave;ixer a l'usuari.</p>
                <p><b>Quina mena de <i>cookies</i> utilitza aquesta p&agrave;gina web?</b></p>
                <ul>
                    <li><i>Cookies</i> d'an&agrave;lisi: s&oacute;n aquelles que correctament tractades per nosaltres mateixos o tercers, ens permeten quantificar el nombre d'usuaris i aix&iacute; realitzar l'an&agrave;lisi estad&iacute;stic de l'&uacute;s que fan els usuaris del servei ofertat. &Eacute;s per aquest motiu que analitzem la seva navegaci&oacute; amb l'objectiu de millorar el nostre servei.</li>
                    <li>Altres <i>cookies</i>: elements de seguretat que intervenen en el control d'acc&eacute;s a les &agrave;rees restringides.</li>
                </ul>
                <p><b>Com desactivo o elimino les <i>cookies</i> del meu navegador?</b></p>
                <ul>
                    <li><a href="https://support.mozilla.org/t5/Cookies-y-cach%C3%A9/Habilitar-y-deshabilitar-cookies-que-los-sitios-web-utilizan/ta-p/13811" target="_blank">Mozilla Firefox</a></li>
                    <li><a href="https://support.microsoft.com/es-es/help/17442/windows-internet-explorer-delete-manage-cookies" target="_blank">Internet Explorer</a></li>
                    <li><a href="https://support.google.com/chrome/answer/95647?co=GENIE.Platform%3DDesktop&hl=es" target="_blank">Google Chrome</a></li>
                    <li><a href="http://help.opera.com/Windows/11.50/es-ES/cookies.html" target="_blank">Opera</a></li>
                </ul>
                <p><b>Qui utilitza les <i>cookies</i>?</b></p>
                <p>El Centre de Lectura utilitza <i>Google Analytics</i> per analitzar el tr&agrave;fic d'aquesta p&agrave;gina web, i <b>no</b> cedeix les dades recollides a terceres persones.</p>
            </div>
        </div>
        <script type="text/javascript">
            Bdcdl.cookieAlert();
        </script>


