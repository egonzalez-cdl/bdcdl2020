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

if (!isset($loopRecordVarName))
    return;

if(isset($maxCols) && is_numeric($maxCols)) {
    switch ($maxCols) {
        case 1:
            $rowClass = 'row row-cols-1';
            break;
        case 2:
            $rowClass = 'row row-cols-1 row-cols-md-2';
            break;
        case 3:
            $rowClass = 'row row-cols-1 row-cols-md-2 row-cols-lg-3';
            break;
        case 4:
            $rowClass = 'row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4';
    }
}
else {
    $rowClass = 'row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4';
}
?>

<div class="<?php echo $rowClass; ?>">
<?php
foreach (loop($loopRecordVarName) as $record):
    if(is_a($record, 'SearchText')) {
        $recordType = $record['record_type'];
        $item = get_record_by_id($recordType, $record['record_id']);
        set_current_record($recordType, $item);
    }
    else if (is_a($record, 'Item')) {
        $item = $record;
    } else {
        return;
    }

    $itemTitle =  snippet_by_word_count(metadata($item, array('Dublin Core', 'Title')), $maxWords = 25, $ellipsis = '...');
    $itemDescription = snippet_by_word_count(metadata($item, array('Dublin Core', 'Description')), $maxWords = 35, $ellipsis = '...'); ?>
    <div class="col mb-4">
        <div class="card shadow-sm">
            <?php
            if (metadata($item, 'has_files')) {
                $srcRapidLoadImg = img('rapid-load-image.jpg', 'images');
                $imgTag = item_image('thumbnail', array('class' => 'card-img-top lazy'));
                preg_match('/src=\"(.*?)\"/', $imgTag, $match);
                $srcImg = '';
                if (!empty($match))
                    $srcImg = $match[1];
                // ------------ Temporal URL redirigida al CdL --------------
                // $srcImg = str_replace('http://localhost/bd.centrelectura.cat-dev', 'https://bd.centrelectura.cat', $srcImg);
                // ----------------------------------------------------------
                $replacement = 'src="' . $srcRapidLoadImg .'" data-src="' . $srcImg . '" data-srcset=""';
                $imgTag = preg_replace('/src=\"(.*)\"/', $replacement, $imgTag);
                echo link_to_item($imgTag);
            }
            ?>
            <div class="card-body">
                <?php if ($itemTitle !== '' && $itemTitle !== '[Sense títol]'): ?>
                <h5 class="card-title entry-title p-name"><?php echo link_to_item($itemTitle, array('rel' => 'bookmark', 'class' => 'u-url text-dark')); ?></h5>
                <?php endif; ?>
                <p class="card-text entry-summary p-summary text-black-50"><?php echo $itemDescription; ?></p>
            </div>
            <div class="card-footer bg-transparent">
                <?php
                $iconCollection = '<svg class="bi bi-collection" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M14.5 13.5h-13A.5.5 0 011 13V6a.5.5 0 01.5-.5h13a.5.5 0 01.5.5v7a.5.5 0 01-.5.5zm-13 1A1.5 1.5 0 010 13V6a1.5 1.5 0 011.5-1.5h13A1.5 1.5 0 0116 6v7a1.5 1.5 0 01-1.5 1.5h-13zM2 3a.5.5 0 00.5.5h11a.5.5 0 000-1h-11A.5.5 0 002 3zm2-2a.5.5 0 00.5.5h7a.5.5 0 000-1h-7A.5.5 0 004 1z" clip-rule="evenodd"/></svg>';
                $html = '<ul class="list-group list-group-flush">';
                if (plugin_is_active('MultiCollections')) {
                    $multiCollections = multicollections_get_collections_for_item($item);
                    if (empty($multiCollections)) {
                        $html .= '<li class="list-group-item">';
                        $html .= $iconCollection . ' ';
                        $html .= link_to_collection_for_item($props = array('class' => 'text-muted'));
                        $html .= '</li>';
                    }
                    // List of collections.
                    else {
                        foreach ($multiCollections as $multiCollection) {
                            $html .= '<li class="list-group-item">';
                            $html .= $iconCollection . ' ';
                            $html .= multicollections_link_to_items_in_collection(
                                metadata($multiCollection, array('Dublin Core', 'Title')),
                                array('class' => 'text-muted'),
                                'browse',
                                $multiCollection);
                            $html .= '</li>';
                        }
                    }
                } else {
                    $html .= '<li class="list-group-item">';
                    $html .= $iconCollection . ' ';
                    $html .= link_to_collection_for_item($props = array('class' => 'text-muted'));
                    $html .= '</li>';
                }
                $html .= '</ul>';
                echo $html;
                ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>