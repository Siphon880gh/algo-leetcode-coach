<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Score of a Split',
    'leetcode' => 3788,
    'difficulty' => 'Med',
    'summary' => 'Precompute suffix minimums from the right, then sweep i with a running prefix sum: score(i) = prefix(i) − sufMin[i+1]. Keep the best.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-score-of-a-split',
    'related_session' => 'maximum-score-of-a-split',
];
