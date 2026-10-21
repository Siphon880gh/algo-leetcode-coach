<?php
declare(strict_types=1);

return [
    'title' => 'Can I Win: bitmask memo on the set of used numbers',
    'leetcode' => 464,
    'difficulty' => 'Med',
    'summary' => 'Players alternately pick unused numbers from 1..maxChoosableInteger and add them to a running total; whoever reaches desiredTotal first wins. With maxChoosableInteger ≤ 20, memoize win/lose on the bitmask of used numbers (the total follows from the mask). If the sum of 1..max is below the target, nobody wins → false. 10, 11 → false. 10, 0 → true.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'bitmask', 'game-theory', 'memoization', 'leetcode'],
    'related_session' => 'can-i-win',
];
