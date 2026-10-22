<?php
declare(strict_types=1);

return [
    'title' => 'Find the Number of Ways to Place People I: sort, then track the highest y below',
    'leetcode' => 3025,
    'difficulty' => 'Med',
    'summary' => 'Sort by x ascending and, for equal x, y descending. For each A, scan later points; B with y ≤ A’s y is a valid pair when its y is above every earlier such y, because any earlier one would sit inside the rectangle.',
    'category' => 'LeetCode',
    'subcategory' => 'Geometry',
    'topic' => 'LeetCode · Geometry',
    'kind' => 'algo',
    'tags' => ['geometry', 'array', 'math', 'enumeration', 'sorting', 'leetcode'],
    'related_session' => 'find-the-number-of-ways-to-place-people-i',
];
