<?php
declare(strict_types=1);

return [
    'title' => 'Find Maximum Value in a Constrained Sequence',
    'leetcode' => 3796,
    'difficulty' => 'Med',
    'summary' => 'Each position has a cap (its restriction, a[0] = 0). Sweep left to right: cap[i+1] = min(cap[i+1], cap[i] + diff[i]); then right to left: cap[i] = min(cap[i], cap[i+1] + diff[i]). The tightened caps are achievable; return the largest.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-maximum-value-in-a-constrained-sequence',
    'related_session' => 'find-maximum-value-in-a-constrained-sequence',
];
