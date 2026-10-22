<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Rows Covered by Columns: try every column set',
    'leetcode' => 2397,
    'difficulty' => 'Med',
    'summary' => 'With at most 12 columns, try every set of exactly numSelect columns as a bitmask. A row is covered when its 1-bits are inside the mask, so count rows with row & ~mask = 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'kind' => 'algo',
    'tags' => ['array', 'backtracking', 'bit-manipulation', 'matrix', 'enumeration', 'leetcode'],
    'related_session' => 'maximum-rows-covered-by-columns',
];
