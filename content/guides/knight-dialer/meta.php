<?php
declare(strict_types=1);

return [
    'title' => 'Knight Dialer: DP over the ten digits',
    'leetcode' => 935,
    'difficulty' => 'Med',
    'summary' => 'The state is just the digit the knight stands on. Each step, the count for a digit is the sum of the counts of the digits that can jump to it. Repeat n − 1 times and sum all ten.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'graphs', 'leetcode'],
    'related_session' => 'knight-dialer',
];
