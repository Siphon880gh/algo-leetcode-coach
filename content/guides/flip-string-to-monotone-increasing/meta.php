<?php
declare(strict_types=1);

return [
    'title' => 'Flip String to Monotone Increasing: flips versus ones so far',
    'leetcode' => 926,
    'difficulty' => 'Med',
    'summary' => 'Scan left to right keeping the number of 1s seen and the best flip count for the prefix. A 0 either gets flipped (flips + 1) or all earlier 1s get flipped (ones); take the smaller.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'strings', 'prefix-sum', 'leetcode'],
    'related_session' => 'flip-string-to-monotone-increasing',
];
