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

$pageTitle = __('Search') . ' <small class="text-muted">' . __('(%s total)', $total_results) . '</small>';
$pageDescription = 'Cerca r&agrave;pida d&#39;&iacute;tems';
echo head(array('title' => $pageTitle, 'page' => 'items', 'description' => $pageDescription));
?>

<div class="container-fluid">
    <div class="row flex-xl-nowrap">
        <?php echo common('left-sidebar', null, 'common'); ?>

        <main class="col-md-9 col-lg-10 pb-md-3 pt-4 pl-md-5">
            <h1 class="display-4">
                <?php echo $pageTitle; ?>
            </h1>
            <?php
            $paginationLinks = pagination_links(
                array(
                    'scrolling_style' => 'sliding',
                    'partial_file' => 'common/pagination-control.php',
                    'page_range' => 5)
            );
            if ($paginationLinks !== ''):
                ?>
                <div class="pt-3 pl-3 mb-3 bg-light border-top border-bottom">
                    <?php echo $paginationLinks; ?>
                </div>
            <?php endif; ?>

            <?php if ($total_results > 0): ?>
                <?php echo common('grid-items-preview', array('loopRecordVarName' => 'search_texts'), 'common'); ?>
            <?php else: ?>
                <h4>No hi han resultats per mostrar.</h4>
            <?php endif; ?>

            <?php if ($paginationLinks !== ''): ?>
                <div class="pt-3 pl-3 mb-3 bg-light border-top border-bottom">
                    <?php echo $paginationLinks; ?>
                </div>
            <?php endif; ?>
        </main>
    </div>
</div>
<?php echo foot();