<?php
declare(strict_types=1);

return [
    'title' => 'Number of Atoms: a stack of counters for parentheses',
    'leetcode' => 726,
    'difficulty' => 'Hard',
    'summary' => 'Parse left to right. Push a new counter at "(", and at ")" pop it, multiply by the number that follows, and merge into the counter below. Element names are an uppercase letter plus lowercase letters, each with an optional count.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'kind' => 'algo',
    'tags' => ['stack', 'parsing', 'hash-map', 'strings', 'leetcode'],
    'related_session' => 'number-of-atoms',
];
