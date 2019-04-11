<?php

namespace DDDCommon;

/**
 * Interface IdentityGenerator
 * @package DDDCommon
 */
interface IdentityGenerator
{
    /**
     * @param string $prefix
     * @return string
     */
    public function nextIdentity($prefix = ''): string;
}
