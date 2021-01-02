<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Lauant\Forge\Symfony\Component\Console\Descriptor;

use Lauant\Forge\Symfony\Component\Console\Application;
use Lauant\Forge\Symfony\Component\Console\Command\Command;
use Lauant\Forge\Symfony\Component\Console\Exception\InvalidArgumentException;
use Lauant\Forge\Symfony\Component\Console\Input\InputArgument;
use Lauant\Forge\Symfony\Component\Console\Input\InputDefinition;
use Lauant\Forge\Symfony\Component\Console\Input\InputOption;
use Lauant\Forge\Symfony\Component\Console\Output\OutputInterface;
/**
 * @author Jean-François Simon <jeanfrancois.simon@sensiolabs.com>
 *
 * @internal
 */
abstract class Descriptor implements \Lauant\Forge\Symfony\Component\Console\Descriptor\DescriptorInterface
{
    /**
     * @var OutputInterface
     */
    private $output;
    /**
     * {@inheritdoc}
     */
    public function describe(\Lauant\Forge\Symfony\Component\Console\Output\OutputInterface $output, $object, array $options = array())
    {
        $this->output = $output;
        switch (\true) {
            case $object instanceof \Lauant\Forge\Symfony\Component\Console\Input\InputArgument:
                $this->describeInputArgument($object, $options);
                break;
            case $object instanceof \Lauant\Forge\Symfony\Component\Console\Input\InputOption:
                $this->describeInputOption($object, $options);
                break;
            case $object instanceof \Lauant\Forge\Symfony\Component\Console\Input\InputDefinition:
                $this->describeInputDefinition($object, $options);
                break;
            case $object instanceof \Lauant\Forge\Symfony\Component\Console\Command\Command:
                $this->describeCommand($object, $options);
                break;
            case $object instanceof \Lauant\Forge\Symfony\Component\Console\Application:
                $this->describeApplication($object, $options);
                break;
            default:
                throw new \Lauant\Forge\Symfony\Component\Console\Exception\InvalidArgumentException(\sprintf('Object of type "%s" is not describable.', \get_class($object)));
        }
    }
    /**
     * Writes content to output.
     *
     * @param string $content
     * @param bool   $decorated
     */
    protected function write($content, $decorated = \false)
    {
        $this->output->write($content, \false, $decorated ? \Lauant\Forge\Symfony\Component\Console\Output\OutputInterface::OUTPUT_NORMAL : \Lauant\Forge\Symfony\Component\Console\Output\OutputInterface::OUTPUT_RAW);
    }
    /**
     * Describes an InputArgument instance.
     *
     * @return string|mixed
     */
    protected abstract function describeInputArgument(\Lauant\Forge\Symfony\Component\Console\Input\InputArgument $argument, array $options = array());
    /**
     * Describes an InputOption instance.
     *
     * @return string|mixed
     */
    protected abstract function describeInputOption(\Lauant\Forge\Symfony\Component\Console\Input\InputOption $option, array $options = array());
    /**
     * Describes an InputDefinition instance.
     *
     * @return string|mixed
     */
    protected abstract function describeInputDefinition(\Lauant\Forge\Symfony\Component\Console\Input\InputDefinition $definition, array $options = array());
    /**
     * Describes a Command instance.
     *
     * @return string|mixed
     */
    protected abstract function describeCommand(\Lauant\Forge\Symfony\Component\Console\Command\Command $command, array $options = array());
    /**
     * Describes an Application instance.
     *
     * @return string|mixed
     */
    protected abstract function describeApplication(\Lauant\Forge\Symfony\Component\Console\Application $application, array $options = array());
}
