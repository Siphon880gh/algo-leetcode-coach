<?php
declare(strict_types=1);

return [
    'title' => 'Painting a Grid With Three Different Colors: column-state DP',
    'leetcode' => 1931,
    'difficulty' => 'Hard',
    'summary' => 'm ≤ 5, so enumerate the valid colourings of one column (no equal vertical neighbours; 48 for m = 5). DP across the n columns, moving between compatible columns (no equal cells in any row).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'bitmask', 'leetcode'],
    'related_session' => 'painting-a-grid-with-three-different-colors',
];
