<?php
declare(strict_types=1);

return [
    'title' => 'Smallest Rotation with Highest Score: mark losing rotations with a difference array',
    'leetcode' => 798,
    'difficulty' => 'Hard',
    'summary' => 'An element with value v at index i fails to score for exactly one cyclic range of rotations, k in [i − v + 1, i] (mod n). Add those ranges to a difference array and pick the rotation with the fewest failures, smallest k on ties.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'kind' => 'algo',
    'tags' => ['prefix-sum', 'arrays', 'leetcode'],
    'related_session' => 'smallest-rotation-with-highest-score',
];
