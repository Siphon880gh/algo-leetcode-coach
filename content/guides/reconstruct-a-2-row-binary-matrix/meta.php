<?php
declare(strict_types=1);

return [
    'title' => 'Reconstruct a 2-Row Binary Matrix: twos first, then ones',
    'leetcode' => 1253,
    'difficulty' => 'Med',
    'summary' => 'A column sum of 2 needs a 1 in both rows and 0 needs none. Place those first, then give each column sum of 1 to the upper row while upper capacity remains and to the lower row otherwise; fail if any count does not end at 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'matrix', 'leetcode'],
    'related_session' => 'reconstruct-a-2-row-binary-matrix',
];
