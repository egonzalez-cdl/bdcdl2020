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
?>

<div class="col-lg-3 offset-md-3 offset-lg-0 col-md-9 py-3 position-sticky sidebar right-sidebar bg-light">
    <div class="pt-4 pb-2">
        <nav aria-label="Page navigation item">
            <ul class="pagination">
                <li class="page-item">
                    <?php
                    echo link_to_previous_item_show(
                        '<span aria-hidden="true">&laquo;</span> &Iacute;tem anterior',
                        array('class' => 'page-link', 'aria-label' => 'Previous')
                    );
                    ?>
                </li>
                <li class="page-item">
                    <?php
                    echo link_to_next_item_show(
                        '&Iacute;tem seg&uuml;ent <span aria-hidden="true">&raquo;</span>',
                        array('class' => 'page-link', 'aria-label' => 'Next')
                    );
                    ?>
                </li>
            </ul>
        </nav>
    </div>

    <?php
    $tagsForItem = get_records('Tag', array('sort_field' => 'name', 'sort_dir' => 'a', 'record' => $item), -1);
    if (!empty($tagsForItem)) :
    ?>
    <div class="py-4 border-top">
        <h5></span><?php echo __('Tags'); ?></h5>
        <ul class="list-group">
            <?php foreach ($tagsForItem as $tag) : ?>
            <?php $itemsForTag = get_records('Item', array('tag' => $tag), -1); ?>
            <li class="list-group-item">
                <a href="<?php echo url('items/browse?tags=' . $tag->name); ?>"><?php echo ($tag->name); ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
        <?php endif; ?>

    <div class="py-4 border-top">
        <h5>
            <?php echo __('Citation'); ?>
        </h5>
        <?php echo metadata('item', 'citation', array('no_escape' => true)); ?>
    </div>
    <div class="py-4 border-top">
        <h5>Llic&egrave;ncia</h5>
        <a rel="license"
           href="http://creativecommons.org/licenses/by-nc-nd/4.0/"
           target="_blank">
            <img alt="Licencia de Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-nd/4.0/88x31.png" />
        </a>
    </div>
    <div class="py-4 border-top">
        <?php echo get_specific_plugin_hook_output('ItemsFeedback', 'public_items_show', array('view' => $this, 'item' => $item)); ?>
    </div>
</div>