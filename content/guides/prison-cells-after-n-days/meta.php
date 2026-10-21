<?php
declare(strict_types=1);

return [
    'title' => 'Prison Cells After N Days: find the cycle',
    'leetcode' => 957,
    'difficulty' => 'Med',
    'summary' => 'From day 1 on, the two end cells are always 0, so only 2⁶ states exist and the sequence repeats (with period 14 in practice). Simulate, remember when each state was seen, and jump ahead by whole cycles.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['hash-table', 'simulation', 'bit-manipulation', 'leetcode'],
    'related_session' => 'prison-cells-after-n-days',
];
