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

if ($this->pageCount > 1):
    $getParams = $_GET;

if (isset($this->pagesInRange)) {
    $extendedPagination = (count($pagesInRange) > 2 ? true : false);
}

?>

<nav aria-label="Page navigation browse items">
    <ul class="pagination">

    <?php if (isset($this->first)): ?>
        <li class="page-item<?php echo ($first === $this->current ? ' active' : ''); ?>"<?php echo ($extendedPagination ? ' style="margin-right: 15px;"' : ''); ?>>
            <?php $getParams['page'] = $first; ?>
            <a class="page-link" href="<?php echo html_escape($this->url(array(), null, $getParams)); ?>" aria-label="First">
                <?php echo $first; ?>
            </a>
        </li>
    <?php endif; ?>

    <?php foreach ($this->pagesInRange as $key => $pageNumber): ?>
        <?php if ($pageNumber !== $first && $pageNumber !== $last): ?>
        <li class="page-item<?php echo ($pageNumber === $this->current ? ' active' : ''); ?>">
            <?php $getParams['page'] = $pageNumber; ?>
            <a class="page-link" href="<?php echo html_escape($this->url(array(), null, $getParams)); ?>">
                <?php echo $pageNumber; ?>
            </a>
        </li>
        <?php endif; ?>
    <?php endforeach; ?>

    <?php if (isset($this->last)): ?>
        <li class="page-item<?php echo ($last === $this->current ? ' active' : ''); ?>"<?php echo ($extendedPagination ? ' style="margin-left: 15px;"' : ''); ?>>
            <?php $getParams['page'] = $last; ?>
            <a class="page-link" href="<?php echo html_escape($this->url(array(), null, $getParams)); ?>" aria-label="Last">
                <?php echo $last; ?>
            </a>
        </li>
    <?php endif; ?>
    </ul>
</nav>

<?php endif; ?>