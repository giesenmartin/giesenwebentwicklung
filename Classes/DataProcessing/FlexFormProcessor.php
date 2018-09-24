<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Giesen\Giesenwebentwicklung\DataProcessing;

use Giesen\Giesenwebentwicklung\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Service\TypoScriptService;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * Minimal TypoScript configuration
 * Process field pi_flexform and overrides the values stored in data
 *
 * 10 = BK2K\BootstrapPackage\DataProcessing\FlexFormProcessor
 *
 *
 * Advanced TypoScript configuration
 * Process field assigned in fieldName and stores processed data to new key
 *
 * 10 = BK2K\BootstrapPackage\DataProcessing\FlexFormProcessor
 * 10 {
 *   fieldName = pi_flexform
 *   as = flexform
 * }
 */

class FlexFormProcessor implements DataProcessorInterface
{

    /**
     * @var \TYPO3\CMS\Extbase\Service\TypoScriptService
     */
    protected $typoScriptService;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->typoScriptService = GeneralUtility::makeInstance(TypoScriptService::class);
    }

    /**
     * @param ContentObjectRenderer $cObj The data of the content element or page
     * @param array $contentObjectConfiguration The configuration of Content Object
     * @param array $processorConfiguration The configuration of this processor
     * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
     * @return array the processed data as key/value store
     */
    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ) {
        $originalValue = $processedData['data']['pi_flexform'];
        $flexForm = $this->convertFlexFormContentToArray($originalValue);
        $data = [
            'data' => $cObj->data,
            'settings' => $this->typoScriptService->convertTypoScriptArrayToPlainArray(
                (array)$contentObjectConfiguration['variables.']['settings.']
            )
        ];
        $data['settings'] = array_merge($data['settings'], $flexForm['settings']);
        return $data;
    }

    /**
     * Convert XML to FlexForm
     *      Note: flexFormService->convertFlexFormContentToArray() seems to be broken for xml of facultymenu
     *
     * @param string $xml
     * @return array
     */
    protected function convertFlexFormContentToArray($xml)
    {
        $array = GeneralUtility::xml2array($xml);
        $flexForm = [];
        foreach ((array) $array['data'] as $sheetTitle => $sheet) {
            foreach ((array) $sheet['lDEF'] as $fieldTitle => $field) {

                // simple
                if (empty($field['el']) && !empty($field['vDEF'])) {
                    $flexForm[$fieldTitle] = $field['vDEF'];

                    // advanced
                } elseif (!empty($field['el'])) {
                    foreach ((array) $field['el'] as $number => $fieldConfiguration) {
                        foreach ((array) array_keys($fieldConfiguration) as $key) {
                            if ($key[0] === '_') {
                                continue;
                            }
                            foreach ((array) $fieldConfiguration[$key]['el'] as $fieldTitle2 => $field2) {
                                $flexForm[$fieldTitle][$number][$key][$fieldTitle2] = $field2['vDEF'];
                            }
                        }
                    }
                }
            }
        }
        return ArrayUtility::resolveArrayPathsRecursive($flexForm);
    }
}
