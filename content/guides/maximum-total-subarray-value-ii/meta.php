<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Total Subarray Value II: a heap of shrinking right ends',
    'leetcode' => 3691,
    'difficulty' => 'Hard',
    'summary' => 'For a fixed l, the value of [l, r] never grows as r shrinks. Start every l at r = n − 1 in a max-heap and pop k times, pushing (l, r − 1) after each pop. A sparse table gives each range max and min in O(1).',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['greedy', 'segment-tree', 'array', 'heap', 'leetcode'],
    'related_session' => 'maximum-total-subarray-value-ii',
];
