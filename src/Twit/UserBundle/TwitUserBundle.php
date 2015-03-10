<?php

namespace Twit\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TwitUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
