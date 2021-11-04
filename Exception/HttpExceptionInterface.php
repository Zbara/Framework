<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zbara\Framework\Exception;

/**
 * Interface for HTTP error exceptions.
 *
 * @author Kris Wallsmith <kris@symfony.com>
 */
interface HttpExceptionInterface extends \Throwable
{
    public function getStatusCode();
    public function getHeaders();
}
