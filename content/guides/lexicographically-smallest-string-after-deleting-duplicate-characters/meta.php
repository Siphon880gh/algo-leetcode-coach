<?php
declare(strict_types=1);

return [
    'title' => 'Lexicographically Smallest String After Deleting Duplicate Characters: monotonic stack',
    'leetcode' => 3816,
    'difficulty' => 'Hard',
    'summary' => 'Every letter must keep at least one copy. Pop a larger top while its letter still has a copy later in s or lower in the stack. At the end, drop trailing letters that still have another copy, since a prefix is smaller.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'kind' => 'algo',
    'tags' => ['stack', 'greedy', 'hash-table', 'string', 'monotonic-stack', 'leetcode'],
    'related_session' => 'lexicographically-smallest-string-after-deleting-duplicate-characters',
];
