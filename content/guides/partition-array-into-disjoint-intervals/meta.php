<?php
declare(strict_types=1);

return [
    'title' => 'Partition Array into Disjoint Intervals: move the cut when something smaller appears',
    'leetcode' => 915,
    'difficulty' => 'Med',
    'summary' => 'Keep the max of the current left part and the max seen overall. When an element is smaller than the left max, it must join the left part: move the cut to it and the left max becomes the overall max.',
    'category' => 'LeetCode',
    'subcategory' => 'Arrays',
    'topic' => 'LeetCode · Arrays',
    'kind' => 'algo',
    'tags' => ['arrays', 'prefix-sum', 'leetcode'],
    'related_session' => 'partition-array-into-disjoint-intervals',
];
