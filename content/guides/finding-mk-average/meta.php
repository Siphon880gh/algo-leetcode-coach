<?php
declare(strict_types=1);

return [
    'title' => 'Finding MK Average: three sorted buckets over a window',
    'leetcode' => 1825,
    'difficulty' => 'Hard',
    'summary' => 'Keep the last m values in a queue and split them into three sorted multisets: the k smallest, the middle, and the k largest, with a running sum of the middle. Each add (and each eviction) moves at most a few elements between buckets.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'ordered-set', 'queue', 'leetcode'],
    'related_session' => 'finding-mk-average',
];
