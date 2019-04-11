<?php

namespace DDDCommon\Mailer;

interface EmailTransport
{
    /**
     * @param EmailInterface $email
     * @return bool
     */
    public function send(EmailInterface $email): bool;
}
