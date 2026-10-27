<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Deletions to Make Alternating Substring',
    'leetcode' => 3777,
    'difficulty' => 'Hard',
    'summary' => 'Each pair of equal neighbours inside [l, r] forces exactly one deletion. Store bad[i] = (s[i] = s[i+1]) in a Fenwick tree; a flip at j updates bad[j−1] and bad[j]; a query sums bad over l..r−1.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'tags' => ['range-tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-deletions-to-make-alternating-substring',
    'related_session' => 'minimum-deletions-to-make-alternating-substring',
];
