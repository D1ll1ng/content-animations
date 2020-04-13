<?php

if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

// register own renderType
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1552428667] = [
    'nodeName' => 'animationPreview',
    'priority' => '40',
    'class' => \Baschte\ContentAnimations\Form\Elements\AnimationPreviewField::class
];

// register own typoscript FILECONTENT cObject
if(!isset($GLOBALS['TYPO3_CONF_VARS']['FE']['ContentObjects']['FILECONTENT'])) {
	$GLOBALS['TYPO3_CONF_VARS']['FE']['ContentObjects'] = array_merge(
		$GLOBALS['TYPO3_CONF_VARS']['FE']['ContentObjects'],
		['FILECONTENT' => \Baschte\ContentAnimations\ContentObject\FileContentContentObject::class]
	);
}

//@todo: change this to new ExtensionConfiguration api on the next TYPO3 version
$extensionConfiguration = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['content_animations']);

// register PageLayoutViewAnimationFooterPreview to tt_content_drawFooter hook if this feature is active
if (empty($extensionConfiguration['hideFooterAnimationLabel']) || !$extensionConfiguration['hideFooterAnimationLabel']) {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawFooter'][] = \Baschte\ContentAnimations\Hooks\PageLayoutView\PageLayoutViewAnimationFooterPreview::class;
}
