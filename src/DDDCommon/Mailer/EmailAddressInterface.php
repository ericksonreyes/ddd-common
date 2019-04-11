<?php

namespace DDDCommon\Mailer;

interface EmailAddressInterface
{
    /**
     * @return string
     */
    public function emailAddress(): string;

    /**
     * @return string
     */
    public function name(): string;
}
