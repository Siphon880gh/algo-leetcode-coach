<?php
declare(strict_types=1);

return [
    'title' => 'Length of Longest V-Shaped Diagonal Segment: memo on cell, direction and turn',
    'leetcode' => 3459,
    'difficulty' => 'Hard',
    'summary' => 'From each 1, try the four diagonals. f(i, j, dir, turned) is how far the 2, 0, 2, 0 pattern continues from (i, j): keep the direction, or, if not yet turned, turn clockwise once. Memoize it.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['memoization', 'array', 'dynamic-programming', 'matrix', 'leetcode'],
    'related_session' => 'length-of-longest-v-shaped-diagonal-segment',
];
