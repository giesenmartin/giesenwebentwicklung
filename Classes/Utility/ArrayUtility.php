<?php

namespace Giesen\Giesenwebentwicklung\Utility;

use TYPO3\CMS\Core\Utility\ArrayUtility as ArrayUtilityCore;

/**
 * Class ArrayUtility
 */
class ArrayUtility extends ArrayUtilityCore
{
    /**
     * Extract array on dots
     *
     *  [
     *      'key.key2' => 'value'
     *  ]
     *
     *      =>
     *
     *  [
     *      'key' =>
     *      [
     *          'key2' => 'value'
     *      ]
     *  ]
     *
     * @param array $array
     * @return array
     */
    public static function resolveArrayPathsRecursive(array $array)
    {
        $newArray = [];
        foreach ($array as $originalKey => &$value) {
            if (is_array($value)) {
                $value = self::resolveArrayPathsRecursive($value);
            }
            if (stristr($originalKey, '.')) {
                $keys = explode('.', $originalKey);
                $currentKey = $keys[0];
                unset($keys[0]);
                if (!empty($keys)) {
                    if (array_key_exists($currentKey, $newArray)) {
                        self::mergeRecursiveWithOverrule(
                            $newArray[$currentKey],
                            self::resolveArrayPathsRecursive(
                                [implode('.', $keys) => $value]
                            )
                        );
                    } else {
                        $newArray[$currentKey] = self::resolveArrayPathsRecursive([implode('.', $keys) => $value]);
                    }
                }
            } else {
                if (array_key_exists($originalKey, $newArray)) {
                    self::mergeRecursiveWithOverrule($newArray[$originalKey], $value);
                } else {
                    $newArray[$originalKey] = $value;
                }
            }
        }
        return $newArray;
    }
}
