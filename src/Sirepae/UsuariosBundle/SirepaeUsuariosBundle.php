<?php

namespace Sirepae\UsuariosBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SirepaeUsuariosBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
