<?php
declare(strict_types=1);

return [
    'title' => 'Longest Balanced Substring After One Swap: prefix balance off by two',
    'leetcode' => 3900,
    'difficulty' => 'Med',
    'summary' => 'Track prefix balance (+1 for 1, −1 for 0). A difference of 0 is already balanced. A difference of ±2 can be fixed by one swap only if the extra side has a partner outside the substring, so check the earliest matching prefix, and the second earliest if the first fails.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'kind' => 'algo',
    'tags' => ['hash-table', 'string', 'prefix-sum', 'leetcode'],
    'related_session' => 'longest-balanced-substring-after-one-swap',
];
