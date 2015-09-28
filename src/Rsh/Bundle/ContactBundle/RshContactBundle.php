<?php

namespace Rsh\Bundle\ContactBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class RshContactBundle extends Bundle
{
    public function getParent()
    {
        return 'MremiContactBundle';
    }
}
