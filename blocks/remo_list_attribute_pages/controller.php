<?php

defined('C5_EXECUTE') or die('Access Denied.');

class RemoListAttributePagesBlockController extends BlockController {

	protected $btTable = 'btRemoListAttributePages';
	protected $btInterfaceWidth = '600';
	protected $btInterfaceHeight = '465';
	protected $btCacheBlockRecord = true;
	protected $btCacheBlockOutput = false;
	protected $btCacheBlockOutputOnPost = false;
	protected $btCacheBlockOutputForRegisteredUsers = false;
	protected $btCacheBlockOutputLifetime = CACHE_LIFETIME;
	protected $btWrapperClass = 'ccm-ui';

	public function getBlockTypeDescription() {
		return t('Lists pages connected to the current page.');
	}

	public function getBlockTypeName() {
		return t('Connected Page List');
	}

	public function view() {
		$c = Page::getCurrentPage();

		$this->set('akHandle', $this->akHandle);

		$pageIds = $c->getAttribute($this->akHandle);
		$pages = array();
		if (is_array($pageIds)) {
			foreach ($pageIds as $pageId) {
				$pages[] = Page::getByID($pageId);
			}
		}
		$this->set('pages', $pages);
	}

	public function edit() {
		$c = Page::getCurrentPage();
		if ($c->isMasterCollection()) {
			$attributes = AttributeKey::getList('collection');
		} else {
			$attributes = $c->getSetCollectionAttributes();
		}

		// filter non page list attributes
		$availableAttributes = array();
		foreach ($attributes as $attribute) {
			if ($attribute->getAttributeType()->getAttributeTypeHandle() == 'remo_page_list_attribute') {
				$availableAttributes[] = $attribute;
			}
		}

		$this->set('availableAttributes', $availableAttributes);
	}

	public function add() {
		$this->edit();
	}

}
