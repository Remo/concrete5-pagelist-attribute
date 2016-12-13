<?php

defined('C5_EXECUTE') or die('Access Denied.');

class RemoPageListAttributePackage extends Package {

	protected $pkgHandle = 'remo_page_list_attribute';
	protected $appVersionRequired = '5.6.2.1';
	protected $pkgVersion = '0.0.7';

	public function getPackageDescription() {
		return t('Adds an attribute where you can select pages.');
	}

	public function getPackageName() {
		return t('Pagelist Attribute');
	}

	public function install() {
		$pkg = parent::install();

		$ci = new ContentImporter();
		$ci->importContentFile($pkg->getPackagePath() . '/install.xml');
	}

	public function upgrade() {
		$pkg = Package::getByHandle($this->pkgHandle);
		$ci = new ContentImporter();
		try {
			$ci->importContentFile($pkg->getPackagePath() . '/install.xml');
		} catch (Exception $ex) {
			
		}

		parent::upgrade();
	}

}
