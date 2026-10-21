<?php
declare(strict_types=1);

return [
    'title' => 'Number of Ways to Paint N × 3 Grid: two row patterns',
    'leetcode' => 1411,
    'difficulty' => 'Hard',
    'summary' => 'A valid row is either ABA (two colours, 6 ways) or ABC (three colours, 6 ways). Below an ABA row there are 3 ABA and 2 ABC options; below an ABC row there are 2 of each. Iterate these counts.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'math', 'leetcode'],
    'related_session' => 'number-of-ways-to-paint-n-3-grid',
];
