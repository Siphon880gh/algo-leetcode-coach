<?php
declare(strict_types=1);

return [
    'title' => 'Separate Squares II: union width per strip with a segment tree',
    'leetcode' => 3454,
    'difficulty' => 'Hard',
    'summary' => 'Sweep upward over square bottoms and tops. A segment tree over the compressed x-coordinates gives the covered width between consecutive heights, so each strip adds width × height. Find the strip where the running area reaches half and interpolate.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'kind' => 'algo',
    'tags' => ['segment-tree', 'array', 'binary-search', 'sweep-line', 'leetcode'],
    'related_session' => 'separate-squares-ii',
];
