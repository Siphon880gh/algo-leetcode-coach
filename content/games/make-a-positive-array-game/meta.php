<?php
declare(strict_types=1);

return [
    'title' => 'Make a Positive Array: replace the right end of the first bad window',
    'leetcode' => 3511,
    'difficulty' => 'Med',
    'summary' => 'Scan left to right with prefix sums. A window of length at least 3 ending at i is bad when pre[i plus 1] is at most the largest pre[l] with l at most i minus 2, counting only since the last replacement. Replace nums[i] with a huge value, which fixes every window through i, and restart the tracking after it.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['mini-game', 'leetcode', 'greedy'],
    'entry' => 'index.html',
    'related_guide' => 'make-a-positive-array',
    'related_session' => 'make-a-positive-array',
];
