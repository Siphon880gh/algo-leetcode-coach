<?php
declare(strict_types=1);

return [
    'title' => 'Zero Array Transformation III: greedy with the farthest-reaching query',
    'leetcode' => 3362,
    'difficulty' => 'Med',
    'summary' => 'Sweep left to right. When index i needs more decrements, use an available query covering i that reaches farthest right. The answer is the number of queries never used.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'prefix-sum', 'sorting', 'heap', 'leetcode'],
    'related_session' => 'zero-array-transformation-iii',
];
