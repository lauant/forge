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

use Lauant\Forge\Symfony\Component\Console\Exception\LogicException;
use Lauant\Forge\Symfony\Component\Console\Formatter\OutputFormatter;
use Lauant\Forge\Symfony\Component\Console\Input\InputInterface;
use Lauant\Forge\Symfony\Component\Console\Output\OutputInterface;
use Lauant\Forge\Symfony\Component\Console\Question\ChoiceQuestion;
use Lauant\Forge\Symfony\Component\Console\Question\ConfirmationQuestion;
use Lauant\Forge\Symfony\Component\Console\Question\Question;
use Lauant\Forge\Symfony\Component\Console\Style\SymfonyStyle;
/**
 * Symfony Style Guide compliant question helper.
 *
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class SymfonyQuestionHelper extends \Lauant\Forge\Symfony\Component\Console\Helper\QuestionHelper
{
    /**
     * {@inheritdoc}
     */
    public function ask(\Lauant\Forge\Symfony\Component\Console\Input\InputInterface $input, \Lauant\Forge\Symfony\Component\Console\Output\OutputInterface $output, \Lauant\Forge\Symfony\Component\Console\Question\Question $question)
    {
        $validator = $question->getValidator();
        $question->setValidator(function ($value) use($validator) {
            if (null !== $validator) {
                $value = $validator($value);
            } else {
                // make required
                if (!\is_array($value) && !\is_bool($value) && 0 === \strlen($value)) {
                    throw new \Lauant\Forge\Symfony\Component\Console\Exception\LogicException('A value is required.');
                }
            }
            return $value;
        });
        return parent::ask($input, $output, $question);
    }
    /**
     * {@inheritdoc}
     */
    protected function writePrompt(\Lauant\Forge\Symfony\Component\Console\Output\OutputInterface $output, \Lauant\Forge\Symfony\Component\Console\Question\Question $question)
    {
        $text = \Lauant\Forge\Symfony\Component\Console\Formatter\OutputFormatter::escapeTrailingBackslash($question->getQuestion());
        $default = $question->getDefault();
        switch (\true) {
            case null === $default:
                $text = \sprintf(' <info>%s</info>:', $text);
                break;
            case $question instanceof \Lauant\Forge\Symfony\Component\Console\Question\ConfirmationQuestion:
                $text = \sprintf(' <info>%s (yes/no)</info> [<comment>%s</comment>]:', $text, $default ? 'yes' : 'no');
                break;
            case $question instanceof \Lauant\Forge\Symfony\Component\Console\Question\ChoiceQuestion && $question->isMultiselect():
                $choices = $question->getChoices();
                $default = \explode(',', $default);
                foreach ($default as $key => $value) {
                    $default[$key] = $choices[\trim($value)];
                }
                $text = \sprintf(' <info>%s</info> [<comment>%s</comment>]:', $text, \Lauant\Forge\Symfony\Component\Console\Formatter\OutputFormatter::escape(\implode(', ', $default)));
                break;
            case $question instanceof \Lauant\Forge\Symfony\Component\Console\Question\ChoiceQuestion:
                $choices = $question->getChoices();
                $text = \sprintf(' <info>%s</info> [<comment>%s</comment>]:', $text, \Lauant\Forge\Symfony\Component\Console\Formatter\OutputFormatter::escape(isset($choices[$default]) ? $choices[$default] : $default));
                break;
            default:
                $text = \sprintf(' <info>%s</info> [<comment>%s</comment>]:', $text, \Lauant\Forge\Symfony\Component\Console\Formatter\OutputFormatter::escape($default));
        }
        $output->writeln($text);
        if ($question instanceof \Lauant\Forge\Symfony\Component\Console\Question\ChoiceQuestion) {
            $width = \max(\array_map('strlen', \array_keys($question->getChoices())));
            foreach ($question->getChoices() as $key => $value) {
                $output->writeln(\sprintf("  [<comment>%-{$width}s</comment>] %s", $key, $value));
            }
        }
        $output->write(' > ');
    }
    /**
     * {@inheritdoc}
     */
    protected function writeError(\Lauant\Forge\Symfony\Component\Console\Output\OutputInterface $output, \Exception $error)
    {
        if ($output instanceof \Lauant\Forge\Symfony\Component\Console\Style\SymfonyStyle) {
            $output->newLine();
            $output->error($error->getMessage());
            return;
        }
        parent::writeError($output, $error);
    }
}
