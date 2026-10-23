<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Score After N Operations: later operations weigh more',
    'leetcode' => 1799,
    'difficulty' => 'Hard',
    'summary' => 'f(mask) = best score with the numbers in mask used; operation number = pairs used + 1. Try every free pair: op · gcd(a, b) + f(mask | pair).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximize-score-after-n-operations',
    'related_session' => 'maximize-score-after-n-operations',
];
