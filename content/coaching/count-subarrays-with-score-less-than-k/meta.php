<?php
declare(strict_types=1);

return [
    'title' => 'Count Subarrays With Score Less Than K: strict bound, count the window',
    'leetcode' => 2302,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: shrink while the score is ≥ k, add the window length, and multiply in 64-bit. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'related_guide' => 'count-subarrays-with-score-less-than-k',
    'tags' => ['array', 'binary-search', 'prefix-sum', 'sliding-window', 'step-by-step'],
];
