<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Insertions to Balance a Parentheses String: track needed closers',
    'leetcode' => 1541,
    'difficulty' => 'Med',
    'summary' => 'Each ( needs two ). Track `need`. On (, if need is odd, insert one ) first. On ), decrement need; if it goes negative, insert a ( (cost 1) and need becomes 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'kind' => 'algo',
    'tags' => ['stack', 'greedy', 'strings', 'leetcode'],
    'related_session' => 'minimum-insertions-to-balance-a-parentheses-string',
];
