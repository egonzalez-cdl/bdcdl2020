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

if (!empty($formActionUri)):
    $formAttributes['action'] = $formActionUri;
else:
    $formAttributes['action'] = url(array('controller'=>'items', 'action'=>'browse'));
endif;
$formAttributes['method'] = 'GET';
?>
<hr class="mt-4">
<h5>Cerca &iacute;tems per...</h5>
<form <?php echo tag_attributes($formAttributes); ?>>
    <div id="search-keywords" class="field">
        <div class="form-group row">
            <?php echo $this->formLabel('keyword-search', 'paraula clau', array('class' => 'col-sm-2 col-form-label')); ?>
            <div class="col-sm-10">
            <?php
            echo $this->formText(
                'search',
                @$_REQUEST['search'],
                array('id' => 'keyword-search', 'class' => 'form-control')
            );
            ?>
            </div>
        </div>
    </div>

    <div id="search-narrow-by-fields" class="field">
        <?php echo 'per camps espec&iacute;fics'; ?>
        <button style="margin: 10px 0 10px 20px;"
                type="button"
                class="add_search btn btn-outline-secondary">
            <?php echo __('Add a Field'); ?>
            <svg class="bi bi-plus" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 3.5a.5.5 0 01.5.5v4a.5.5 0 01-.5.5H4a.5.5 0 010-1h3.5V4a.5.5 0 01.5-.5z" clip-rule="evenodd"/>
                <path fill-rule="evenodd" d="M7.5 8a.5.5 0 01.5-.5h4a.5.5 0 010 1H8.5V12a.5.5 0 01-1 0V8z" clip-rule="evenodd"/>
            </svg>
        </button>

        <?php
        // If the form has been submitted, retain the number of search
        // fields used and rebuild the form
        if (!empty($_GET['advanced'])) {
            $search = $_GET['advanced'];
        } else {
            $search = array(array('field'=>'','type'=>'','value'=>''));
        }

		// Search Fields ordered:
        $db = get_db();
		$sql = "
		SELECT e.id AS element_id, e.name AS element_name, it.name AS item_type_name
		FROM {$db->Element} e INNER JOIN {$db->ItemTypesElements} ite ON
		e.id = ite.element_id AND e.element_set_id = 3 INNER JOIN
		{$db->ItemType} it ON ite.item_type_id = it.id
		ORDER BY it.name, e.name";
        $elements = $db->fetchAll($sql);
        $options = array();
        foreach ($elements as $element) {
            $optGroup = $element['item_type_name']
                ? __('Item Type') . ': ' . __($element['item_type_name'])
                : __($element['element_set_name']);
            $value = __($element['element_name']);

            $options[$optGroup][$element['element_id']] = $value;
        }
		
        //Here is where we actually build the search form
        foreach ($search as $i => $rows): ?>
        <div class="search-entry">
            <div class="row">
				<div class="col-md-2 col-for-advanced-joiner">
				<?php
				echo $this->formSelect(
                    "advanced[$i][joiner]",
                    @$rows['joiner'],
                    array(
                        'title' => __("Search Joiner"),
                        'id' => null,
                        'class' => 'advanced-search-joiner form-control'
                    ),
                    array(
                        'and' => __('AND'),
                        'or' => __('OR'),
                    )
                );
				?>
				</div>
                <div class="col-md-4">
                <?php
                //The POST looks like =>
                // advanced[0] =>
                //[field] = 'description'
                //[type] = 'contains'
                //[terms] = 'foobar'
                //etc
                echo $this->formSelect(
                    "advanced[$i][element_id]",
                    @$rows['element_id'],
                    array(
                        'title' => __("Search Field"),
                        'id' => null,
                        'class' => 'form-control'
                    ),
                    $options
                );
                ?>
                </div>
                <div class="col-md-4">
                <?php
                echo $this->formSelect(
                    "advanced[$i][type]",
                    @$rows['type'],
                    array(
                        'title' => __("Search Type"),
                        'id' => null,
                        'class' => 'form-control'
                    ),
                    label_table_options(array(
                        'contains' => __('contains'),
                        'does not contain' => __('does not contain'),
                        'is exactly' => __('is exactly'),
                        'is empty' => __('is empty'),
                        'is not empty' => __('is not empty'))
                    )
                );
                ?>
                </div>
            </div><!-- .row -->
			<div class="row" style="margin-top: 10px;">
				<div class="col-md-12">
                <?php
                echo $this->formText(
                    "advanced[$i][terms]",
                    @$rows['terms'],
                    array(
                        'size' => '20',
                        'title' => __("Search Terms"),
                        'id' => null,
                        'class' => 'form-control'
                    )
                );
                ?>
                </div>
			</div><!-- .row -->
            <button type="button"
                    style="margin: 10px 0 15px 0; display: none;"
                    class="remove_search btn btn-outline-secondary"
                    disabled="disabled">
                <?php echo __('Remove field'); ?>
                <svg class="bi bi-x" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 010 .708l-7 7a.5.5 0 01-.708-.708l7-7a.5.5 0 01.708 0z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 000 .708l7 7a.5.5 0 00.708-.708l-7-7a.5.5 0 00-.708 0z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
    <?php endforeach; ?>
    </div>

    <div id="search-by-range" class="field mt-4">
        <div class="form-group row">
            <?php echo $this->formLabel('range', 'per rang d\'IDs', array('class' => 'col-sm-2 col-form-label')); ?>
            <div class="col-sm-10">
            <?php
                echo $this->formText('range', @$_GET['range'],
                    array('class' => 'form-control', 'placeholder' => 'exemple: 1-4, 156, 79')
                );
            ?>
            </div>
        </div>
    </div>

    <hr>
    <h5>Limita els resultats per...</h5>
    <div class="field">
        <div class="form-group row">
        <?php echo $this->formLabel('collection-search', 'col·lecció', array('class' => 'col-sm-2 col-form-label')); ?>
            <div class="col-sm-10">
            <?php
            if (plugin_is_active('MultiCollections')) {
                echo $this->formSelect(
                    'multi-collection',
                    @$_REQUEST['multi-collection'],
                    array('id' => 'multi-collection-search', 'class' => 'form-control'),
                    get_table_options('Collection', null, array('include_no_collection' => true))
                );
            } else {
                echo $this->formSelect(
                    'collection',
                    @$_REQUEST['collection'],
                    array('id' => 'collection-search', 'class' => 'form-control'),
                    get_table_options('Collection', null, array('include_no_collection' => true))
                );
            }
            ?>
            </div>
        </div>
    </div>

    <div class="field">
        <div class="form-group row">
        <?php echo $this->formLabel('item-type-search', 'tipus d\'ítem', array('class' => 'col-sm-2 col-form-label')); ?>
            <div class="col-sm-10">
            <?php
                echo $this->formSelect(
                    'type',
                    @$_REQUEST['type'],
                    array('id' => 'item-type-search', 'class' => 'form-control'),
                    get_table_options('ItemType')
                );
            ?>
            </div>
        </div>
    </div>

    <?php if(is_allowed('Users', 'browse')): ?>
    <div class="field">
        <div class="form-group row">
        <?php echo $this->formLabel('user-search', 'usuari', array('class' => 'col-sm-2 col-form-label'));?>
            <div class="col-sm-10">
            <?php
                echo $this->formSelect(
                    'user',
                    @$_REQUEST['user'],
                    array('id' => 'user-search', 'class' => 'form-control'),
                    get_table_options('User')
                );
            ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="field">
        <div class="form-group row">
        <?php echo $this->formLabel('tag-search', 'etiquetes', array('class' => 'col-sm-2 col-form-label')); ?>
            <div class="col-sm-10">
            <?php
                echo $this->formText('tags', @$_REQUEST['tags'],
                    array('class' => 'form-control', 'id' => 'tag-search')
                );
            ?>
            </div>
        </div>
    </div>

    <?php if (is_allowed('Items','showNotPublic')): ?>
    <div class="field">
        <div class="form-group row">
        <?php echo $this->formLabel('public', __('Public/Non-Public'), array('class' => 'col-sm-2 col-form-label')); ?>
            <div class="col-sm-10">
            <?php
                echo $this->formSelect(
                    'public',
                    @$_REQUEST['public'],
                    array('class' => 'form-control'),
                    label_table_options(array(
                        '1' => __('Only Public Items'),
                        '0' => __('Only Non-Public Items')
                    ))
                );
            ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="field">
        <div class="form-group row">
        <?php echo $this->formLabel('featured', __('Featured/Non-Featured'), array('class' => 'col-sm-2 col-form-label')); ?>
            <div class="col-sm-10">
            <?php
                echo $this->formSelect(
                    'featured',
                    @$_REQUEST['featured'],
                    array('class' => 'form-control'),
                    label_table_options(array(
                        '1' => __('Only Featured Items'),
                        '0' => __('Only Non-Featured Items')
                    ))
                );
            ?>
            </div>
        </div>
    </div>
    <?php //fire_plugin_hook('public_items_search', array('view' => $this)); ?>
    <div>
        <?php if (!isset($buttonText)) $buttonText = __('Search for items'); ?>
        <input
                style="margin-bottom: 20px;"
                type="submit"
                class="submit btn btn-primary"
                name="submit_search"
                id="submit_search_advanced"
                value="<?php echo $buttonText ?>">
    </div>
</form>

<?php echo js_tag('items-search'); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        Omeka.Search.activateSearchButtons();
    });
</script>
