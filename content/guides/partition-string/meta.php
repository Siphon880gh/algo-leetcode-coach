<?php
declare(strict_types=1);

return [
    'title' => 'Partition String: grow until unseen',
    'leetcode' => 3597,
    'difficulty' => 'Med',
    'summary' => 'Keep a set of segments already taken. Extend the current piece one character at a time; as soon as it is not in the set, record it and start a new piece.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'kind' => 'algo',
    'tags' => ['trie', 'hash-table', 'string', 'simulation', 'leetcode'],
    'related_session' => 'partition-string',
];
