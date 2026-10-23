<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Deletions to Make Alternating Substring: Fenwick tree of equal pairs',
    'leetcode' => 3777,
    'difficulty' => 'Hard',
    'summary' => 'Deletions needed for s[l..r] = equal adjacent pairs inside it. Keep e[i] = (s[i] = s[i + 1]) in a Fenwick tree; a flip at j changes e[j − 1] and e[j].',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Indexed Tree',
    'topic' => 'LeetCode · Binary Indexed Tree',
    'kind' => 'algo',
    'tags' => ['segment-tree', 'string', 'leetcode'],
    'related_session' => 'minimum-deletions-to-make-alternating-substring',
];
