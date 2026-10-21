<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Make Array Equal: sum of distances to the mean',
    'leetcode' => 1551,
    'difficulty' => 'Med',
    'summary' => 'arr[i] = 2i + 1 has mean n. Each operation moves 1 from a big element to a small one, so the answer is the total excess above n: Σ over the lower half of (n − arr[i]) = ⌊n/2⌋ · ⌈n/2⌉.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'leetcode'],
    'related_session' => 'minimum-operations-to-make-array-equal',
];
