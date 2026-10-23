<?php
declare(strict_types=1);

return [
    'title' => 'Count Stepping Numbers in Range: neighbors differ by 1',
    'leetcode' => 2801,
    'difficulty' => 'Hard',
    'summary' => 'Digit DP over (position, last digit, tight, started): the next digit must be last ± 1. Answer = count(high) − count(low) + (low is stepping).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-stepping-numbers-in-range',
    'related_session' => 'count-stepping-numbers-in-range',
];
