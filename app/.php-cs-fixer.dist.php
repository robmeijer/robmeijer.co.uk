<?php

declare(strict_types=1);

$finder = new PhpCsFixer\Finder()
    ->in('src')
    ->in('tests')
;

return new PhpCsFixer\Config()
    ->setParallelConfig(PhpCsFixer\Runner\Parallel\ParallelConfigFactory::detect())
    ->setRules([
        '@Symfony' => true,
        'class_attributes_separation' => [
            'elements' => ['const' => 'one', 'method' => 'one', 'property' => 'one', 'trait_import' => 'one'],
        ],
        'concat_space' => ['spacing' => 'one'],
        'phpdoc_line_span' => ['const' => 'single', 'method' => 'single', 'property' => 'single'],
        'single_line_empty_body' => true,
    ])
    ->setCacheFile(__DIR__ . '/var/php-cs-fixer/.php-cs-fixer.cache')
    ->setFinder($finder)
;
