<?php
declare(strict_types=1);

return [
    'title' => 'The Number of Good Subsets: square-free values as prime masks',
    'leetcode' => 1994,
    'difficulty' => 'Hard',
    'summary' => 'Only square-free values 2..30 can be used; each is a mask of primes. dp over prime masks counts subsets with disjoint masks (multiplied by the value\'s count). Finally multiply by 2^(count of 1s).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'the-number-of-good-subsets',
    'related_session' => 'the-number-of-good-subsets',
];
