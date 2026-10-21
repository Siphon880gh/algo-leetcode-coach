<?php
declare(strict_types=1);

return [
    'title' => 'Number of Ways of Cutting a Pizza: suffix apple counts and DP',
    'leetcode' => 1444,
    'difficulty' => 'Hard',
    'summary' => 'dp(i, j, c) = ways to cut the pizza with top-left corner (i, j) into c pieces. A suffix-sum grid answers "does this part have an apple?" in O(1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dp', 'prefix-sum', 'matrix', 'leetcode'],
    'related_session' => 'number-of-ways-of-cutting-a-pizza',
];
