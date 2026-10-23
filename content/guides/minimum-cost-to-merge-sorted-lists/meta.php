<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Merge Sorted Lists: bitmask DP over subsets',
    'leetcode' => 3801,
    'difficulty' => 'Hard',
    'summary' => 'A merged list is the sorted union of its lists, so its length and median depend only on which lists went in. With at most 12 lists, f[mask] = cnt[mask] + min over splits of f[part] + f[rest] + |med[part] − med[rest]|.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'array', 'two-pointers', 'binary-search', 'dynamic-programming', 'leetcode'],
    'related_session' => 'minimum-cost-to-merge-sorted-lists',
];
