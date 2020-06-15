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

$imageFiles = array();
$audioFiles = array();
$otherFiles = array();

if (isset($item) && metadata('item', 'has_files')) {
    $files = $item->Files;
    foreach ($files as $file) {
        $mimeType = $file->mime_type;
        if (stripos($mimeType, 'image') !== false) {
            array_push($imageFiles, $file);
        } else if (stripos($mimeType, 'audio') !== false) {
            array_push($audioFiles, $file);
        } else {
            array_push($otherFiles, $file);
        }
    }
}

/*function tempURL($fileTag) {
    $fileTag = str_replace('http://localhost/bd.centrelectura.cat-dev', 'https://bd.centrelectura.cat', $fileTag);
    return $fileTag;
}*/

?>
<?php if(!empty($imageFiles)): ?>
<div id="filesCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <?php
        $fileMarkup = file_markup(
            $imageFiles,
            array('imageSize' => 'fullsize',
                'linkToFile' => 'fullsize',
                'imgAttributes' => array('alt' => metadata('item', array('Item Type Metadata', 'Títol')))),
            array('class' => 'carousel-item')
        );
        //echo tempURL($fileMarkup);
        echo $fileMarkup;
        ?>
    </div>
    <a class="carousel-control-prev" href="#filesCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#filesCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<?php endif; ?>

<?php if (!empty($audioFiles)) : ?>
    <?php foreach ($audioFiles as $audio): ?>
        <a class="audio-link" href="<?php echo metadata($audio, 'uri'); ?>" style="display: none;"><?php echo metadata($audio, 'display_title'); ?></a>
    <?php endforeach; ?>
    <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
    </div>
    <p id="audio-message" style="display: none;">En aquests moments no es poden consultar tots els arxius del fons sonor. Adreceu-vos a la <a style="float: none; margin: 0;" href="http://www.centrelectura.cat/cdlweb/?page_id=186" target="_blank">Biblioteca</a> del Centre de Lectura per poder consultar els arxius. Disculpeu les mol&egrave;sties.</p>
<?php endif; ?>

<?php if (!empty($otherFiles)) : ?>
    <table class="table table-condensed">
        <thead><tr><th>#</th><th>Fitxer</th><th>Tipus</th></tr></thead>
        <tbody>
        <?php $inc = 0; ?>
        <?php foreach($otherFiles as $otherFile) : ?>
            <tr>
                <th scope="row"><?php echo ++$inc; ?></th>
                <td><a href="<?php echo $otherFile->getWebPath('original'); ?>">Document <?php echo $inc; ?></a></td>
                <td><?php echo $otherFile->mime_type; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
