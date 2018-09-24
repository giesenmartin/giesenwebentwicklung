<?php








if (!is_array($GLOBALS['TCA']['tt_content']['types']['startslider'])) {
    $GLOBALS['TCA']['tt_content']['types']['startslider'] = [];
}
$GLOBALS['TCA']['tt_content']['types']['startslider'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['startslider'],
    [
        'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                ,pi_flexform,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                        --palette--;;language'
    ]
);


if (!is_array($GLOBALS['TCA']['tt_content']['types']['referenceslider'])) {
    $GLOBALS['TCA']['tt_content']['types']['referenceslider'] = [];
}
$GLOBALS['TCA']['tt_content']['types']['referenceslider'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['referenceslider'],
    [
        'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                ,pi_flexform,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                        --palette--;;language'
    ]
);



if (!is_array($GLOBALS['TCA']['tt_content']['types']['textform'])) {
    $GLOBALS['TCA']['tt_content']['types']['textform'] = [];
}
$GLOBALS['TCA']['tt_content']['types']['textform'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['textform'],
    [
        'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
               --palette--;;general,
               --palette--;;headers,
                bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.plugin,
                 pi_flexform,      
          --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,--palette--;;frames,
               --palette--;;appearanceLinks,--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
               --palette--;;language,--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
               --palette--;;hidden,--palette--;;access,--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
          --div--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_category.tabs.category,
                   categories,
          --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,rowDescription,
          --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended'
    ]
);










\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    ['Start Slider', 'startslider', 'startslider']
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    ['Referenzen Slider', 'referenceslider', 'referenceslider']
);


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    ['Text Form Element', 'textform', 'textform']
);





\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    '*',
    'FILE:EXT:giesenwebentwicklung/Configuration/Flexforms/ContentElements/StartSlider.xml',
    'startslider'
);


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    '*',
    'FILE:EXT:giesenwebentwicklung/Configuration/Flexforms/ContentElements/ReferenceSlider.xml',
    'referenceslider'
);


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    '*',
    'FILE:EXT:form/Configuration/FlexForms/FormFramework.xml',
    'textform'
);




/*

$tca = [
    'types' => [
        'giesen_slider' => [
            'showitem' => '--palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,pi_flexform,' .
                '--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,--palette--;' .
                'LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility'
        ]
    ]
];
$GLOBALS['TCA']['tt_content'] = array_replace_recursive($GLOBALS['TCA']['tt_content'], $tca);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    ['Slideshow', 'giesen_slider', 'giesen_slider']
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    '*',
    'FILE:EXT:in2template/Configuration/FlexForms/ContentElements/Slider.xml',
    'in2template_slider'
);
*/
