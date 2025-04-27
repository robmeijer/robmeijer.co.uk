<?php

declare(strict_types=1);

$finder = new PhpCsFixer\Finder()
    ->in('src')
    ->in('tests')
;

return new PhpCsFixer\Config()
    ->setParallelConfig(PhpCsFixer\Runner\Parallel\ParallelConfigFactory::detect())
    ->setRules([
        '@PER-CS' => true,
    ])
    ->setCacheFile(__DIR__ . '/var/php-cs-fixer/.php-cs-fixer.cache')
    ->setFinder($finder)
;
