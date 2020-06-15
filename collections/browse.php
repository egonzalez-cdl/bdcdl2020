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

$pageTitle = __('Browse Collections');
$pageDescription = 'La Biblioteca Digital del Centre de Lectura agrupa ' . total_records('Item') . ' &iacute;tems en '
    . total_records('Collection') . ' col&middot;leccions especials que per la seva naturalesa no es poden '
    . 'consultar a través del seu cat&agrave;leg informatitzat tradicional';
echo head(array('title' => $pageTitle, 'page' => 'collections', 'description' => $pageDescription));
?>

<main>
    <section class="bg-secondary">
        <div class="container p-5 text-light">
            <div class="row">
                <div class="offset-md-1 col-md-3 d-none d-md-block">
                    <svg class="bi bi-collection img-fluid" width="200px" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M14.5 13.5h-13A.5.5 0 011 13V6a.5.5 0 01.5-.5h13a.5.5 0 01.5.5v7a.5.5 0 01-.5.5zm-13 1A1.5 1.5 0 010 13V6a1.5 1.5 0 011.5-1.5h13A1.5 1.5 0 0116 6v7a1.5 1.5 0 01-1.5 1.5h-13zM2 3a.5.5 0 00.5.5h11a.5.5 0 000-1h-11A.5.5 0 002 3zm2-2a.5.5 0 00.5.5h7a.5.5 0 000-1h-7A.5.5 0 004 1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="col-md-6">
                    <h1 class="display-4">
                        <?php echo $pageTitle; ?>
                    </h1>
                    <p class="lead">
                        <?php echo $pageDescription; ?>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container px-md-5 py-md-3">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 mt-4">
                <?php set_loop_records('collections', get_records('Collection', array('sort_field' => 'added', 'sort_dir' => 'd'), -1)); ?>
                <?php foreach (loop('collections') as $collection): ?>
                <?php $collectionTitle = metadata('collection', array('Dublin Core', 'Title')); ?>
                <div class="col mb-4">
                    <div class="card shadow-sm">
                        <?php
                        if ($imgTag = record_image('collection', 'thumbnail', array('class' => 'card-img-top', 'alt' => $collectionTitle))) {
                            // ------------ Temporal URL redirigida al CdL --------------
                            // $imgTag = str_replace('http://localhost/bd.centrelectura.cat-dev', 'https://bd.centrelectura.cat', $imgTag);
                            // ----------------------------------------------------------
                        }
                        else {
                            $imgTag = '<img src="' . img('arxiu-digital.png') . '" class="card-img-top" alt="' . $collectionTitle . '">';
                        }
                        echo link_to_collection($imgTag);
                        ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo link_to_collection($collectionTitle, array('class' => 'text-dark')); ?></h5>
                            <?php $collectionDescription = do_shortcode(metadata('collection', array('Dublin Core', 'Description'))); ?>
                            <p class="card-text text-black-50"><?php echo text_to_paragraphs($collectionDescription); ?></p>
                            <?php
                            if (plugin_is_active('MultiCollections')) {
                                echo multicollections_link_to_items_in_collection(
                                    'Explora els ' . multicollections_total_items_in_collection($collection) . ' &iacute;tems',
                                    array('multi-collection' => metadata('collection', 'id'), 'class' => 'btn btn-outline-secondary'),
                                    'browse',
                                    null
                                );
                            } else {
                                echo link_to_items_browse(
                                    'Explora els ' . metadata('collection', 'total_items') . ' &iacute;tems',
                                    array('collection' => metadata('collection', 'id')),
                                    array('class' => 'btn btn-outline-secondary'));
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>
<?php echo foot();