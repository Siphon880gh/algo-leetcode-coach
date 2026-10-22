<?php
declare(strict_types=1);

return [
    'title' => 'Beautiful Pairs: closest pair under Manhattan distance',
    'leetcode' => 2613,
    'difficulty' => 'Hard',
    'summary' => 'This is the classic closest pair of points problem, with Manhattan instead of Euclidean distance. Sort by x, split in half, solve both halves, and check only the points in a strip of width d around the split, sorted by y.',
    'category' => 'LeetCode',
    'subcategory' => 'Divide and Conquer',
    'topic' => 'LeetCode · Divide and Conquer',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'divide-and-conquer', 'geometry', 'sorting', 'ordered-set', 'leetcode'],
    'related_session' => 'beautiful-pairs',
];
