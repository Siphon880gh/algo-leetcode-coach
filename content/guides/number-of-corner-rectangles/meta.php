<?php
declare(strict_types=1);

return [
    'title' => 'Number Of Corner Rectangles: count shared columns per row pair',
    'leetcode' => 750,
    'difficulty' => 'Med',
    'summary' => 'Two rows with c columns where both have a 1 form c · (c − 1) / 2 rectangles. Equivalently, for each row, every pair of 1-columns adds the number of earlier rows that had the same pair, using a counter keyed by the column pair.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'math', 'matrix', 'hash-map', 'leetcode'],
    'related_session' => 'number-of-corner-rectangles',
];
