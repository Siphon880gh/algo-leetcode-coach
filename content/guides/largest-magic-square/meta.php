<?php
declare(strict_types=1);

return [
    'title' => 'Largest Magic Square: try sizes from large to small',
    'leetcode' => 1895,
    'difficulty' => 'Med',
    'summary' => 'For k from min(m, n) down to 2, check every k × k window: all row sums, column sums and both diagonals must match. Row and column prefix sums make each line O(1). Return the first k that works, else 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Matrix',
    'topic' => 'LeetCode · Matrix',
    'kind' => 'algo',
    'tags' => ['matrix', 'prefix-sum', 'enumeration', 'leetcode'],
    'related_session' => 'largest-magic-square',
];
