<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Path Intersection Sum in a Grid: best row or column run',
    'leetcode' => 3938,
    'difficulty' => 'Med',
    'summary' => 'The shared cells always form one straight run in a row or a column. Any run of length ≥ 2 is possible, but a single cell only away from the border. So take the best run of length ≥ 2 in every row and column, and every inner cell.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'matrix', 'prefix-sum', 'leetcode'],
    'related_session' => 'maximum-path-intersection-sum-in-a-grid',
];
