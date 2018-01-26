<?php

namespace Vmj\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class VmjUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
