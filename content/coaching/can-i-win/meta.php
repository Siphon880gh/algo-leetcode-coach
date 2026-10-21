<?php
declare(strict_types=1);

return [
    'title' => 'Can I Win: bitmask memo on the set of used numbers',
    'leetcode' => 464,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: players take unused numbers 1..max into a running total; reaching desiredTotal wins. Memoize win/lose on the bitmask of used numbers (it fixes the total). If 1 + … + max < desiredTotal, return false. 10, 11 → false. 10, 0 → true. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dynamic-programming', 'bitmask', 'game-theory', 'memoization', 'step-by-step'],
    'related_guide' => 'can-i-win',
];
