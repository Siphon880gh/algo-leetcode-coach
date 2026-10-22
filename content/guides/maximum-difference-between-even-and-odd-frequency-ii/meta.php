<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Difference Between Even and Odd Frequency II: prefix parities for each letter pair',
    'leetcode' => 3445,
    'difficulty' => 'Hard',
    'summary' => 'Fix a (odd) and b (even, non-zero). For a right end r, the best left end l ≤ r − k has the opposite parity of a’s count, the same parity of b’s count, fewer b’s than r, and the smallest count(a) − count(b). Keep that minimum for each of the 4 parity states while l advances.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['string', 'enumeration', 'prefix-sum', 'sliding-window', 'leetcode'],
    'related_session' => 'maximum-difference-between-even-and-odd-frequency-ii',
];
