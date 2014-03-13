<?php
defined('C5_EXECUTE') or die('Access Denied.');

$pl = new PageList();

// filter by selected page types
$selectedPageTypes = preg_split('[,]', $akSelectedPageTypes);
if (is_array($selectedPageTypes) && !empty($selectedPageTypes)) {
	$selectedPageTypesString = join(',', $selectedPageTypes);
	$pl->filter(false, "pt.ctID in ({$selectedPageTypesString})");
}

$pages = $pl->get(0);
?>

<div>
	<?php foreach ($pages as $page) { ?>
		<label for="page_<?php echo $page->getCollectionID() ?>">
			<input <?php echo in_array($page->getCollectionID(), $selectedPages) ? ' checked="checked" ' : '' ?> style="display: inline;" id="page_<?php echo $page->getCollectionID() ?>" type="checkbox" name="pageID[]" value="<?php echo $page->getCollectionID() ?>"/>
			<?php echo $page->getCollectionName() ?>
		</label>
	<?php } ?>
</div>