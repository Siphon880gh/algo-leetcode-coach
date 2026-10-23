<?php
declare(strict_types=1);

return [
    'title' => 'Count of Smaller Numbers After Self',
    'leetcode' => 315,
    'difficulty' => 'Hard',
    'summary' => 'Scan from the right with a Fenwick tree over value ranks: counts[i] = how many already-inserted values are strictly smaller; then insert nums[i].',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'tags' => ['range-tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-of-smaller-numbers-after-self',
    'related_session' => 'count-of-smaller-numbers-after-self',
];
