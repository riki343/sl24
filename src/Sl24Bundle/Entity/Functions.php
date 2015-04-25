<?php

namespace Sl24Bundle\Entity;

/**
 * Class Functions
 * @package Sl24Bundle\Entity
 */
class Functions {
    /**
     * @param $array
     * @return array
     */
    public static function arrayToJson($array) {
        $jsonArray = array();
        if (count($array) > 0) {
            foreach ($array as $item) {
                $jsonArray[] = $item->getInArray();
            }
        }
        return $jsonArray;
    }
}