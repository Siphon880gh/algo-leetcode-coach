<?php
declare(strict_types=1);

return [
    'title' => 'Partition Array Into Two Arrays to Minimize Sum Difference: meet in the middle',
    'leetcode' => 2035,
    'difficulty' => 'Hard',
    'summary' => 'Split into halves of n. For each half, list subset sums grouped by how many elements are taken. Choosing k from the left forces n − k from the right; sort those sums and binary search for the partner that brings the chosen total closest to half the sum.',
    'category' => 'LeetCode',
    'subcategory' => 'Meet in the Middle',
    'topic' => 'LeetCode · Meet in the Middle',
    'kind' => 'algo',
    'tags' => ['meet-in-the-middle', 'binary-search', 'bitmask', 'leetcode'],
    'related_session' => 'partition-array-into-two-arrays-to-minimize-sum-difference',
];
