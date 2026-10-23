<?php
declare(strict_types=1);

return [
    'title' => 'Make a Positive Array: replace the right end of the first bad window',
    'leetcode' => 3511,
    'difficulty' => 'Med',
    'summary' => 'Scan left to right with prefix sums. At index i, a window of length ≥ 3 ending here is bad when pre[i + 1] ≤ the largest pre[t] with t ≤ i − 2 since the last replacement. Replace nums[i] with a huge value, which fixes every window through i',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['mini-game', 'leetcode', 'greedy'],
    'entry' => 'index.html',
    'related_guide' => 'make-a-positive-array',
    'related_session' => 'make-a-positive-array',
];
