<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Time to Build Blocks: merge like Huffman',
    'leetcode' => 1199,
    'difficulty' => 'Hard',
    'summary' => 'Think backwards: the two quickest jobs can share one split. Repeatedly pop the two smallest times a ≤ b from a min-heap and push split + b; the last value is the answer.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['heap', 'greedy', 'leetcode'],
    'related_session' => 'minimum-time-to-build-blocks',
];
