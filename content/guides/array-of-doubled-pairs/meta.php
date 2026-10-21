<?php
declare(strict_types=1);

return [
    'title' => 'Array of Doubled Pairs: match from the smallest absolute value',
    'leetcode' => 954,
    'difficulty' => 'Med',
    'summary' => 'Count the values and process them by absolute value, smallest first. Each x must pair with 2x, so 2x needs at least count[x] copies; subtract and continue. Zero must appear an even number of times.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'hash-table', 'sorting', 'leetcode'],
    'related_session' => 'array-of-doubled-pairs',
];
