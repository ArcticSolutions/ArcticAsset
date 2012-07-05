<?php

namespace Arctic\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ArcticUserBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
