<?php
declare(strict_types=1);

return [
    'title' => 'Find Nearest Point That Has the Same X or Y Coordinate: one scan',
    'leetcode' => 1779,
    'difficulty' => 'Easy',
    'summary' => 'Scan the points; for those sharing x or y with you, keep the index with the smallest Manhattan distance, updating only on strictly smaller distances so the lowest index wins ties.',
    'category' => 'LeetCode',
    'subcategory' => 'Array',
    'topic' => 'LeetCode · Array',
    'kind' => 'algo',
    'tags' => ['array', 'geometry', 'leetcode'],
    'related_session' => 'find-nearest-point-that-has-the-same-x-or-y-coordinate',
];
