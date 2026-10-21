<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Moves to Equal Array Elements II: meet at the median',
    'leetcode' => 462,
    'difficulty' => 'Med',
    'summary' => 'One move adds or subtracts 1 from one element. Fewest moves to make all equal is Σ |x − t|, minimized when t is a median. Sort (or quickselect) and sum distances to nums[n / 2]. Or pair the ends: Σ (nums[n − 1 − i] − nums[i]). [1,2,3] → 2. [1,10,2,9] → 16. Not 453 (mean / min).',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'sorting', 'median', 'leetcode'],
    'related_session' => 'minimum-moves-to-equal-array-elements-ii',
];
