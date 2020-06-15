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

if(!isset($collection))
    return;
$imageUrl = null;
if ($file = $collection->getFile()) {
    $imageUrl = $file->getWebPath($type = 'fullsize');
}

$collectionTitle = metadata('collection', array('Dublin Core', 'Title'));
$collectionDescription = metadata('collection', array('Dublin Core', 'Description'));
echo head(array('title' => $collectionTitle, 'page' => 'collections', 'description' => $collectionDescription, 'imageUrl' => $imageUrl));
?>

<main>
    <section class="bg-secondary">
        <div class="container p-5 text-light">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="display-4">
                        <?php echo $collectionTitle; ?>
                    </h1>
                    <p class="lead">
                        <?php echo do_shortcode($collectionDescription); ?>
                    </p>
                </div>
                <div class="col-md-4 mb-4">
                    <?php
                    if (plugin_is_active('MultiCollections')) {
                        echo multicollections_link_to_items_in_collection(
                            'Explora els ' . multicollections_total_items_in_collection($collection) . ' &iacute;tems',
                            array('multi-collection' => metadata('collection', 'id'), 'class' => 'btn btn-light btn-lg', 'role' => 'button'),
                            'browse',
                            null
                        );
                    } else {
                        echo link_to_items_browse(
                            'Explora els ' . metadata('collection', 'total_items') . ' &iacute;tems',
                            array('collection' => metadata('collection', 'id')),
                            array('class' => 'btn btn-light btn-lg', 'role' => 'button'));
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container px-5 py-md-3">
            <div class="my-4">
                <h3>Darrers &iacute;tems afegits a la col&middot;lecci&oacute;</h3>
            </div>
            <?php if (metadata('collection', 'total_items') > 0) : ?>
                <?php set_loop_records('items', get_records('Item', array('sort_field' => 'added', 'sort_dir' => 'd', 'collection' => $collection), 12)); ?>
                <?php echo common('grid-items-preview', array('loopRecordVarName' => 'items', 'maxCols' => 3), 'common'); ?>
            <?php else: ?>
                <p>No hi han registres disponibles.</p>
            <?php endif; ?>
        </div>
    </section>
</main>
<?php echo foot();