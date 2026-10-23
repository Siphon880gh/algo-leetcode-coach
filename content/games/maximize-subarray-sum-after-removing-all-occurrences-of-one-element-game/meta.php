<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Subarray Sum After Removing All Occurrences of One Element',
    'leetcode' => 3410,
    'difficulty' => 'Hard',
    'summary' => 'Segment tree storing max-subarray info (sum, best prefix, best suffix, best). Removing value x = setting its positions to 0-length; evaluate each candidate negative x by point updates and restore. Array must stay non-empty.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'tags' => ['range-tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximize-subarray-sum-after-removing-all-occurrences-of-one-element',
    'related_session' => 'maximize-subarray-sum-after-removing-all-occurrences-of-one-element',
];
