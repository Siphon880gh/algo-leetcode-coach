<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Possible Maximum Waiting Time: DP over (car, fuel, busy time)',
    'leetcode' => 4009,
    'difficulty' => 'Hard',
    'summary' => 'Car i is allowed exactly when car i − 1 starts. At that moment the dispenser that car i − 1 took is busy for demand[i − 1] seconds, and the other one has some leftover busy time of at most 20. The fuel in one dispenser fixes the other. Memoise (car, fuel in dispenser 0, which dispenser was last, leftover) and keep the best (cars served, maximum wait).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['memoization', 'array', 'dynamic-programming', 'leetcode'],
    'related_session' => 'minimum-possible-maximum-waiting-time',
];
