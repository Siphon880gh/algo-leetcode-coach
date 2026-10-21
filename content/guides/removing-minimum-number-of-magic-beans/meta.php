<?php
declare(strict_types=1);

return [
    'title' => 'Removing Minimum Number of Magic Beans: pick the level',
    'leetcode' => 2171,
    'difficulty' => 'Med',
    'summary' => 'Sort the bags. If the remaining level is b[i], bags below it are emptied and the n − i bags from i keep b[i] each, so the removal is total − b[i] · (n − i). Take the minimum over i.',
    'category' => 'LeetCode',
    'subcategory' => 'Sorting',
    'topic' => 'LeetCode · Sorting',
    'kind' => 'algo',
    'tags' => ['array', 'greedy', 'sorting', 'enumeration', 'prefix-sum', 'leetcode'],
    'related_session' => 'removing-minimum-number-of-magic-beans',
];
