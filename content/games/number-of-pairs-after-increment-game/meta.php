<?php
declare(strict_types=1);

return [
    'title' => 'Number of Pairs After Increment',
    'leetcode' => 3943,
    'difficulty' => 'Hard',
    'summary' => 'nums1 has at most 5 values, so a type-2 query just sums, over each a in nums1, how many nums2 entries equal tot − a. Split nums2 into √n blocks, each with a value-count map and a lazy add; range updates rebuild partial blocks and bump the lazy on whole ones.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'tags' => ['range-tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-pairs-after-increment',
    'related_session' => 'number-of-pairs-after-increment',
];
