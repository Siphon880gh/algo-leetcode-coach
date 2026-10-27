<?php
declare(strict_types=1);

return [
    'title' => 'Closest Equal Element Queries: neighbors in each value’s index list',
    'leetcode' => 3488,
    'difficulty' => 'Med',
    'summary' => 'Group indices by value. Going around the circle, the closest equal index is the previous or next one in that sorted list, wrapping around. The distance between i and j is the smaller of d and n minus d, where d is their difference. A value that appears once gives -1.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'tags' => ['mini-game', 'leetcode', 'hash-table'],
    'entry' => 'index.html',
    'related_guide' => 'closest-equal-element-queries',
    'related_session' => 'closest-equal-element-queries',
];
