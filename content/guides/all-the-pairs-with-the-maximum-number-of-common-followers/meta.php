<?php
declare(strict_types=1);

return [
    'title' => 'All the Pairs With the Maximum Number of Common Followers: self-join and max',
    'leetcode' => 1951,
    'difficulty' => 'Med',
    'summary' => 'Self-join relations on the follower with user_a < user_b, group by the pair to count common followers, then keep pairs whose count equals the maximum (a subquery or RANK()).',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'database', 'joins', 'window-functions', 'leetcode'],
    'related_session' => 'all-the-pairs-with-the-maximum-number-of-common-followers',
];
