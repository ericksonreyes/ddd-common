<?php

namespace DDDCommon\Attributes;

/**
 * Interface Arrayable
 * @package DDDCommon\Attributes
 */
interface Arrayable
{
    /**
     * @return array
     */
    public function toArray(): array;
}
