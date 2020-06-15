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

$pageTitle = 'Cerca avan&ccedil;ada d&#39;&iacute;tems';
$pageDescription = 'Utilitza la cerca avan&ccedil;ada per trobar &iacute;tems a la Biblioteca Digital';
echo head(array('title' => $pageTitle, 'page' => 'items', 'description' => $pageDescription));
?>

<div class="container-fluid">
    <div class="row flex-xl-nowrap">
        <?php echo common('left-sidebar', null, 'common'); ?>

        <main class="col-lg-7 col-md-9 pb-md-3 pt-4 px-md-5">
            <h1 class="display-4">
                <?php echo $pageTitle; ?>
            </h1>
            <?php echo $this->partial('items/search-form.php', array('formAttributes' => array('id' => 'advanced-search-form'))); ?>
        </main>
        <div class="col-lg-3 offset-md-3 offset-lg-0 col-md-9 py-3 position-sticky sidebar right-sidebar bg-light">
            <div class="pt-4 pb-2 px-3">
                <h5>Informaci&oacute; d&#39;utilitat</h5>
                <p>La <u><b>Cerca per Paraula Clau</b></u> &eacute;s semblant a cercar a Google: retornar&agrave; els resultats
                    ordenats per rellev&agrave;ncia. Si busquem "fotografia antiga" prioritzar&agrave; els registres que continguin
                    la cadena sencera "fotografia antiga", per&ograve; tamb&eacute; inclour&agrave; registres que continguin les paraules
                    individuals "fotografia" o "antiga".</p>
                <p>El motor de la base de dades considera que <b>els termes que apareixen en m&eacute;s del 50% dels registres
                        indexats s&oacute;n comuns i els exclour&agrave; de les cerques per paraula clau</b>. Per exemple:
                    "Centre de Lectura" podria apar&egrave;ixer en m&eacute;s del 50% i no es consideraria terme clau.</p>
                <p>El motor de la base de dades no indexa paraules amb llargada inferior a 4 lletres.</p>
            </div>
        </div>
    </div>
</div>

<?php
echo foot();
