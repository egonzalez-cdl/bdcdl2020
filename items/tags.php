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

$pageTitle = 'Etiquetes';
$pageDescription = 'Explora les etiquetes i filtra els &iacute;tems';
echo head(array('title' => $pageTitle, 'page' => 'tags', 'description' => $pageDescription));

$tags = get_records('Tag', array('sort_field' => 'name', 'sort_dir' => 'a', 'type' => 'Item'), -1);
$array_esq = array_filter($tags, function($var) {return (preg_match("/\b\d{4}\b/", $var) === 1);});
$array_dret = array_filter($tags, function($var) {return (preg_match("/\b\d{4}\b/", $var) === 0);});
?>

<div class="container-fluid">
    <div class="row flex-xl-nowrap">
        <?php
        echo common('left-sidebar', array(), 'common');
        ?>

        <main class="col-md-9 col-lg-10 pb-md-3 pt-4 px-md-5">
            <h1 class="display-4">
                <?php echo $pageTitle; ?>
            </h1>
            <div class="row">
                <div class="col-6">
                    <ul class="list-group">
                        <?php foreach ($array_esq as $tag): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="<?php echo url('items/browse?tags=' . $tag->name); ?>"><?php echo ($tag->name); ?></a>
                                <span class="badge badge-secondary badge-pill"><?php echo $tag['tagCount']; ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-6">
                    <ul class="list-group">
                        <?php foreach ($array_dret as $tag): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="<?php echo url('items/browse?tags=' . $tag->name); ?>"><?php echo ($tag->name); ?></a>
                                <span class="badge badge-secondary badge-pill"><?php echo $tag['tagCount']; ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </main>
    </div>
</div>
<?php echo foot();
