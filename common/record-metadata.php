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

foreach ($elementsForDisplay as $setName => $setElements):
    ?>
    <div class="element-set entry-content e-content py-4">
        <div class="table-responsive-sm">
            <table class="table">
                <tbody>
        <?php foreach ($setElements as $elementName => $elementInfo): ?>
                    <tr>
                        <th scope="row"><?php echo html_escape(__($elementName)); ?></th>
                        <td>
                        <?php $multipleTexts = (count($elementInfo['texts']) > 1 ? true : false); ?>
                        <?php echo ($multipleTexts ? '<ol style="padding-left: 15px;">': ''); ?>
                        <?php foreach ($elementInfo['texts'] as $text): ?>
                            <?php echo ($multipleTexts ? '<li>' . $text . '</li>' : $text); ?>
                        <?php endforeach; ?>
                        <?php echo ($multipleTexts ? '</ol>': ''); ?>
                        </td>
                    </tr>
        <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div><!-- end element-set -->
<?php
endforeach;

