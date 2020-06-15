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

if (!isset($item))
    return;

$itemTitle =  snippet_by_word_count(metadata($item, array('Dublin Core', 'Title')), $maxWords = 30, $ellipsis = '...');
$itemDescription = snippet_by_word_count(metadata($item, array('Dublin Core', 'Description')), $maxWords = 50, $ellipsis = '...');

$imageUrl = null;
if (metadata('item', 'has_files') && $item->hasThumbnail()) {
    $imageUrl = $item->getFile(0)->getWebPath($type = 'fullsize');
}


echo head(array('title' => $itemTitle, 'page' => 'items', 'imageUrl' => $imageUrl, 'description' => $itemDescription));

if (plugin_is_active('MultiCollections')) {
    $queryCollections = multicollections_get_collections_for_item();
}
else {
    $queryCollections = get_collection_for_item();
}
$queryCollectionIDs = array();
foreach ($queryCollections as $queryCollection) {
    array_push($queryCollectionIDs, $queryCollection->id);
}
?>

<div class="container-fluid">
    <div class="row flex-xl-nowrap">
        <?php
        // Left Sidebar
        echo common('left-sidebar', array('queryCollectionIDs' => $queryCollectionIDs), 'common');
        ?>

        <main class="col-lg-7 col-md-9 pb-md-3 pt-4 px-md-5">
            <?php if ($itemTitle !== '' && $itemTitle !== '[Sense títol]'): ?>
            <h1 class="display-4">
                <?php echo $itemTitle; ?>
            </h1>
            <?php endif; ?>

            <div class="py-4">
                <?php echo common('item-files', array('item' => $item), 'common'); ?>
            </div>
            <?php echo all_element_texts('item', array('show_element_sets' => array('Dublin Core', 'Item Type Metadata'))); ?>
            <a href="<?php echo metadata('item', 'permalink'); ?>" rel="bookmark" class="u-url" style="display: none;"><?php echo metadata('item', 'permalink'); ?></a>
        </main>

        <?php echo common('right-sidebar', array('item' => $item), 'common'); ?>
    </div>
</div>
<?php echo foot();
