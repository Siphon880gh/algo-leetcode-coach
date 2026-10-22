<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Subarray With OR at Least K II: sliding window with bit counts',
    'leetcode' => 3097,
    'difficulty' => 'Med',
    'summary' => 'OR cannot be undone directly, so keep how many window elements have each bit set. Extend right; while the window’s OR reaches k, record its length and remove the left element.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['array', 'bit-manipulation', 'sliding-window', 'leetcode'],
    'related_session' => 'shortest-subarray-with-or-at-least-k-ii',
];
