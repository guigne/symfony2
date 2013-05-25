<?php

namespace Raf\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class RafUserBundle extends Bundle
{
  public function getParent()
  {
    return 'FOSUserBundle';
  }
}
