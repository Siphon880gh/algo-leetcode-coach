<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Separate Sentence Into Rows: DP over row starts',
    'leetcode' => 2052,
    'difficulty' => 'Med',
    'summary' => 'f(i) = minimum cost to place words i … end. Try each row i … j that fits in k: cost 0 if it is the last row, else (k − len)² + f(j + 1). Memoise over i.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'string', 'leetcode'],
    'related_session' => 'minimum-cost-to-separate-sentence-into-rows',
];
