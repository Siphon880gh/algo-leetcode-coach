<?php
declare(strict_types=1);

return [
    'title' => 'Number of Pairs of Strings With Concatenation Equal to Target: split the target',
    'leetcode' => 2023,
    'difficulty' => 'Med',
    'summary' => 'Count each string. For every split of target into prefix a and suffix b, add cnt[a] · cnt[b], or cnt[a] · (cnt[a] − 1) when a == b so an index is not paired with itself.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['hash-table', 'string', 'counting', 'leetcode'],
    'related_session' => 'number-of-pairs-of-strings-with-concatenation-equal-to-target',
];
