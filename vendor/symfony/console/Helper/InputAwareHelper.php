<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Lauant\Forge\Symfony\Component\Console\Helper;

use Lauant\Forge\Symfony\Component\Console\Input\InputAwareInterface;
use Lauant\Forge\Symfony\Component\Console\Input\InputInterface;
/**
 * An implementation of InputAwareInterface for Helpers.
 *
 * @author Wouter J <waldio.webdesign@gmail.com>
 */
abstract class InputAwareHelper extends \Lauant\Forge\Symfony\Component\Console\Helper\Helper implements \Lauant\Forge\Symfony\Component\Console\Input\InputAwareInterface
{
    protected $input;
    /**
     * {@inheritdoc}
     */
    public function setInput(\Lauant\Forge\Symfony\Component\Console\Input\InputInterface $input)
    {
        $this->input = $input;
    }
}
