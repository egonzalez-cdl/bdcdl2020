<?php
/*
 * MIT License
 *
 * Copyright (c) 2013-2020 Centre de Lectura de Reus
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.

 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

$imageUrl = img('biblioteca-digital.png');
$description = option('description');
$author = option('author');

echo head(array('description' => $description, 'author' => $author, 'page' => 'home', 'imageUrl' => $imageUrl));
?>

<main>
    <section>
        <div class="container p-5">
            <h1 class="display-4">
                Biblioteca Digital del Centre de Lectura
            </h1>
            <p class="lead">
                La Biblioteca Digital del Centre de Lectura vol donar acc&eacute;s a tota una s&egrave;rie de
                col&middot;leccions especials que per la seva naturalesa no es poden consultar a trav&eacute;s
                del seu cat&agrave;leg informatitzat tradicional. D&#39;aquesta manera pret&eacute;n posar a
                disposici&oacute; del p&uacute;blic documents en format .pdf, .doc, .jpg, .bmp, mp3, etc.
            </p>
            <p class="text-muted">El projecte en el qual s&#39;est&agrave; treballant contempla les seg&uuml;ents col&middot;leccions:</p>
            <div class="row text-muted">
                <div class="col-md">
                    <ul>
                        <li>
                            <?php echo link_to('collections', 'show', 'Fons d&#39;art', $props = array('class' => 'text-dark'), array('id' => '1')); ?>:
                            el fons art&iacute;stic que posseeix l’entitat est&agrave; catalogat a la Biblioteca Digital.
                        </li>
                        <li>
                            <?php echo link_to('collections', 'show', 'Fons fotogr&agrave;fic', $props = array('class' => 'text-dark'), array('id' => '2')); ?>:
                            l’entitat posseeix un arxiu fotogr&agrave;fic molt important que ens permet analitzar la seva
                            traject&ograve;ria cultural al llarg de la seva hist&ograve;ria.
                        </li>
                        <li>
                            <?php echo link_to('collections', 'show', 'Fons sonor', $props = array('class' => 'text-dark'), array('id' => '4')); ?>:
                            el Centre de Lectura posseeix un important fons sonor de tots els actes que
                            s&#39;organitzen a l&#39;entitat.
                        </li>
                        <li>
                            <?php echo link_to('collections', 'show', 'Goigs', $props = array('class' => 'text-dark'), array('id' => '3')); ?>:
                            la biblioteca de l&#39;entitat compta amb uns 27.000 goigs, la gran majoria cedits per Enric Prats.
                        </li>
                        <li>
                            Fons local (no obert al p&uacute;blic): el fons local pret&eacute;n donar acc&eacute;s a tots aquells fulletons,
                            targetons, invitacions, etc., d&#39;actes organitzats a la ciutat de Reus i que es difonen
                            a trav&eacute;s de la xarxa.</li>
                    </ul>
                </div>
                <div class="col-md">
                    <ul>
                        <li>
                            <?php echo link_to('collections', 'show', 'Fons Gabriel Ferrater', $props = array('class' => 'text-dark'), array('id' => '14')); ?>:
                            col&middot;lecci&oacute; que recull tot tipus de documents relacionats amb la vida i l&#39;obra del poeta reusenc.
                        </li>
                        <li>
                            <?php echo link_to('collections', 'show', 'Llibres de signatures del Centre de Lectura', $props = array('class' => 'text-dark'), array('id' => '13')); ?>:
                            recull el testimoni de totes les personalitats que han visitat l&#39;entitat.
                        </li>
                        <li>
                            <?php echo link_to('collections', 'show', 'Fons sonor R&agrave;dio Reus', $props = array('class' => 'text-dark'), array('id' => '12')); ?>:
                            inclou entrevistes, informatius especials, plens municipals, entre d&#39;altres documents, del fons sonor d&#39;aquesta emissora.
                        </li>
                        <li>
                            <?php echo link_to('collections', 'show', 'Cartells', $props = array('class' => 'text-dark'), array('id' => '10')); ?>:
                            recull els cartells de les activitats que organitza l&#39;entitat.
                        </li>
                        <li>
                            <?php echo link_to('collections', 'show', 'Fons audiovisual', $props = array('class' => 'text-dark'), array('id' => '9')); ?>:
                            cont&eacute; el cinema amateur i documental relacionat amb la ciutat
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div id="carouselHome" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselHome" data-slide-to="0" class="active"></li>
                <li data-target="#carouselHome" data-slide-to="1"></li>
                <li data-target="#carouselHome" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?php echo img('fons-gabriel-ferrater.jpg'); ?>" class="d-block h-100" alt="Fons Gabriel Ferrater">
                    <div class="carousel-caption">
                        <h5><?php echo link_to('collections', 'show', 'Fons Gabriel Ferrater', $props = array('class' => 'text-light'), array('id' => '14')); ?></h5>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?php echo img('fons-signatures.jpg'); ?>" class="d-block h-100" alt="Llibres de signatures del Centre de Lectura">
                    <div class="carousel-caption">
                        <h5><?php echo link_to('collections', 'show', 'Llibres de signatures del Centre de Lectura', $props = array('class' => 'text-light'), array('id' => '13')); ?></h5>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?php echo img('fons-fotografic.jpeg'); ?>" class="d-block h-100" alt="Fons fotogr&agrave;fic">
                    <div class="carousel-caption">
                        <h5><?php echo link_to('collections', 'show', 'Fons fotogr&agrave;fic', $props = array('class' => 'text-light'), array('id' => '2')); ?></h5>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselHome" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselHome" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
    <section>
        <div class="container px-5 py-md-3">
            <div class="my-4">
                <h3><?php echo __('Recently Added Items'); ?></h3>
            </div>
            <?php set_loop_records('items', get_recent_items(8)); ?>
            <?php if (has_loop_records('items')) : ?>
                <?php echo common('grid-items-preview', array('loopRecordVarName' => 'items', 'maxCols' => 3), 'common'); ?>
            <?php endif; ?>
        </div>
    </section>
    <section class="bg-secondary">
        <div class="container p-5 text-light">
            <div>
                <h3>Enlla&ccedil;os d&#39;inter&egrave;s</h3>
            </div>
            <div class="row text-light">
                <div class="col-md-6">
                    <ul>
                        <li><a class="text-light" href="https://www.centrelectura.cat/clrweb/biblioteca/web/ct/biblioteca_historia.php" target="_blank">Biblioteca</a></li>
                        <li><a class="text-light" href="https://www.centrelectura.cat/clrweb/videoteca/web/ct/index.php" target="_blank">Videoteca</a></li>
                        <li><a class="text-light" href="http://opac.centrelectura.cat/" target="_blank">Cat&agrave;leg de la biblioteca</a></li>
                        <li><a class="text-light" href="http://bibliotecainfantil-clr.blogspot.com.es/" target="_blank">Blog de la biblioteca infantil</a></li>
                        <li><a class="text-light" href="http://mdc1.cbuc.cat/" target="_blank">Mem&ograve;ria digital de Catalunya</a></li>
                        <li><a class="text-light" href="https://www.centrelectura.cat/cdlweb/?page_id=1219" target="_blank">Premsa hist&ograve;rica</a></li>
                        <li><a class="text-light" href="https://www.centrelectura.cat" target="_blank">Centre de Lectura</a></li>
                    </ul>
                    <hr class="border-light">
                </div>
            </div>
            <p>Biblioteca Digital del Centre de Lectura - Any 2020 | <a href="#modalAvisLegal" style="color: white;" data-toggle="modal" title="Av&iacute;s legal">Av&iacute;s legal</a> | <a href="#modalPoliticaPrivacitat" style="color: white;" data-toggle="modal" title="Pol&iacute;tica de privacitat">Pol&iacute;tica de privacitat</a></p>
            <p>&copy; El Centre de Lectura és propietari únic del contingut d'aquest lloc web.</p>
        </div>
    </section>
</main>
<?php echo foot();