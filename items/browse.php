<?php
$pageTitle = __('Browse Items');
echo head(array('title'=>$pageTitle,'bodyclass' => 'items browse'));
?>

<h1><?php echo $pageTitle;?> <?php echo __('(%s total)', $total_results); ?></h1>

<nav class="items-nav navigation secondary-nav">
    <?php echo public_nav_items(); ?>
</nav>

<?php echo item_search_filters(); ?>

<?php echo pagination_links(); ?>

<?php if ($total_results > 0): ?>

<?php
$sortLinks[__('Título')] = 'Dublin Core,Title';
$sortLinks[__('Lugar')] = 'Dublin Core,Spatial Coverage';
$sortLinks[__('Fecha de creación')] = 'added';
$sortLinks[__('Fecha del elemento')] = 'Dublin Core,Date';
$sortLinks[__('Capítulo')] = 'Dublin Core,Capitulo';
?>
<div id="sort-links">
    <span class="sort-label"><?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
</div>

<?php endif; ?>

<?php foreach (loop('items') as $item): ?>
<div class="item record">
    <h2><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class'=>'permalink', 'target'=>'_blank')); ?></h2>
    <div class="item-meta">
    <?php if (metadata('item', 'has files')): ?>
    <div class="item-img">
        <?php echo link_to_item(item_image()); ?>
    </div>
    <?php endif; ?>

    <?php if ($description = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>250))): ?>
    <div class="item-description">
        <?php echo $description; ?>
    </div>
    <?php endif; ?>

    <!--agrega la fecha a cada elemento -->
    <?php if ($date = metadata('item', array('Dublin Core', 'Date'))): ?>
    <div class="item-description">
        <?php echo $date; ?>
    </div>
	<?php endif; ?>

	<!--agrega la fuente a cada elemento -->
    <?php if  ($fuente = metadata('item', array('Dublin Core', 'Source'))): ?>
    <div class="item-description">
    	<?php echo $fuente; ?>
    </div>
    <?php endif; ?>

    <!--agrega el capítulo de cada elemento -->
    <?php if ($capitulo = metadata('item', array('Dublin Core', 'Capitulo'))): ?>
    <div class="item-description">
        <?php echo $capitulo; ?>
    </div>
    <?php endif; ?>

    <?php if (metadata('item', 'has tags')): ?>
    <div class="tags"><p><strong><?php echo __('Tags'); ?>:</strong>
        <?php echo tag_string('items'); ?></p>
    </div>
    <?php endif; ?>

    <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' =>$item)); ?>

    </div><!-- end class="item-meta" -->
</div><!-- end class="item hentry" -->
<?php endforeach; ?>

<?php echo pagination_links(); ?>

<div id="outputs">
    <span class="outputs-label"><?php echo __('Output Formats'); ?></span>
    <?php echo output_format_list(false); ?>
</div>

<?php fire_plugin_hook('public_items_browse', array('items'=>$items, 'view' => $this)); ?>

<?php echo foot(); ?>
