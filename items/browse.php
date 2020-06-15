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

if(!isset($items))
    return;

$pageTitle = __('Browse Items');
$pageDescription = 'Navega pels &iacute;tems de la Biblioteca Digital i filtra per col&middot;leccions i etiquetes';
echo head(array('title' => $pageTitle, 'page' => 'items', 'description' => $pageDescription));
?>

<div class="container-fluid">
    <div class="row flex-xl-nowrap">
        <?php
        // Left Sidebar
        if (isset($_GET['multi-collection'])) {
            $collectionID = $_GET['multi-collection'];
        }
        else if (isset($_GET['collection'])) {
            $collectionID = $_GET['collection'];
        }
        else {
            $collectionID = '0';
        }
        $queryCollectionIDs = array();
        $queryCollectionIDs[] = $collectionID;
        echo common('left-sidebar', array('queryCollectionIDs' => $queryCollectionIDs), 'common');
        ?>

        <main class="col-md-9 col-lg-10 pb-md-3 pt-4 px-md-5">
            <h1 class="display-4">
                <?php echo $pageTitle; ?> <small class="text-muted"><?php echo __('(%s en total)', $total_results); ?></small>
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
                <?php echo common('grid-items-preview', array('loopRecordVarName' => 'items'), 'common'); ?>
            <?php else: ?>
            <h4>No hi han resultats per mostrar.</h4>
            <?php endif; ?>

            <?php if ($paginationLinks !== ''): ?>
            <div class="pt-3 pl-3 mb-3 bg-light border-top border-bottom">
                <?php echo $paginationLinks; ?>
            </div>
            <?php endif; ?>

            <?php fire_plugin_hook('public_items_browse', array('items' => $items, 'view' => $this)); ?>
        </main>
    </div>
</div>
<?php echo foot();
