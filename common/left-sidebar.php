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

if (isset($queryCollectionIDs)) {
    $collectionIDArray = $queryCollectionIDs;
}
else {
    $collectionIDArray = array();
}
?>

<div class="col-lg-2 col-md-3 py-3 position-sticky sidebar left-sidebar bg-light">
    <button class="btn btn-outline-primary d-md-none d-sm-flex"
            type="button"
            data-toggle="collapse"
            data-target="#left-sidebar-div-collapse"
            aria-expanded="true"
            aria-controls="left-sidebar-div-collapse">
        Eines de cerca
    </button>
    <?php set_loop_records('collections', get_records('Collection', array('sort_field' => 'added', 'sort_dir' => 'd'), -1)); ?>
    <div class="flex-column collapse d-md-block" id="left-sidebar-div-collapse">
        <?php $sortLinks[__('Date Added')] = 'added'; ?>
        <div class="pt-3 pb-4">
            <h5><?php echo __('Sort by: ') ?></h5>
            <ul class="nav flex-column">
            <?php echo browse_sort_links($sortLinks, array('link_tag' => 'li class="nav-item"', 'list_tag' => '')); ?>
            </ul>
        </div>
        <div class="py-4 border-top">
            <h5>Col&middot;leccions</h5>
            <ul class="nav flex-column">

                <?php
                foreach (loop('collections') as $collection):
                    $currentCollectionTitle = metadata('collection', array('Dublin Core', 'Title'));
                    $currentCollectionID = metadata('collection', 'id');
                    $currentCollectionIDInArray = in_array($currentCollectionID, $collectionIDArray);

                    $options = ($currentCollectionIDInArray ?
                        array('class' => 'nav-link text-primary active', 'style' => 'padding: 0.2rem 0; font-weight: 500;') :
                        array('class' => 'nav-link text-muted', 'style' => 'padding: 0.2rem 0')
                    );

                    if (plugin_is_active('MultiCollections')) {
                        $linkToCollection = multicollections_link_to_items_in_collection(
                            $currentCollectionTitle,
                            $options,
                            'browse',
                            $collection);
                    }
                    else {
                        $linkToCollection = link_to_items_browse(
                            $currentCollectionTitle,
                            array('collection' => $currentCollectionID),
                            $options);
                    }
                    ?>

                    <li class="nav-item">
                        <?php echo $linkToCollection; ?>
                    </li>
                <?php endforeach; ?>

            </ul>
        </div>
        <div class="py-4 border-top">
            <h5>Cerca</h5>
            <form id="search-form" name="search-form" role="search" action="<?php echo url('search'); ?>" method="get">
                <div class="form-group">
                    <input type="text" class="form-control" id="query" name="query" title="Cerca" placeholder="exemple: Fortuny" required>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="query_type-keyword" name="query_type" value="keyword" class="custom-control-input" checked>
                        <label class="custom-control-label" for="query_type-keyword">Paraula clau</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="query_type-boolean" name="query_type" value="boolean" class="custom-control-input">
                        <label class="custom-control-label" for="query_type-boolean">Booleà</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="query_type-exact_match" name="query_type" value="exact_match" class="custom-control-input">
                        <label class="custom-control-label" for="query_type-exact_match">Exacta</label>
                    </div>
                </div>
                <button type="submit" id="submit_search" name="submit_search" class="btn btn-outline-primary" value="Cerca">
                    Cerca
                    <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 011.415 0l3.85 3.85a1 1 0 01-1.414 1.415l-3.85-3.85a1 1 0 010-1.415z" clip-rule="evenodd"/>
                        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 100-11 5.5 5.5 0 000 11zM13 6.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" clip-rule="evenodd"/>
                    </svg>
                </button>
                <a class="btn btn-outline-secondary" role="button" href="<?php echo url('items/search'); ?>">Cerca avançada</a>
            </form>
        </div>
        <?php $outputFormats = output_format_list(false); ?>
        <?php if ($outputFormats): ?>
        <div class="pt-4 border-top">
            <h5><?php echo __('Output Formats'); ?></h5>
            <?php echo $outputFormats; ?>
        </div>
        <?php endif; ?>
    </div>
</div>