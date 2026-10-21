<?php
declare(strict_types=1);

return [
    'title' => 'Number of Subarrays with Bounded Maximum: count(≤ right) − count(< left)',
    'leetcode' => 795,
    'difficulty' => 'Med',
    'summary' => 'Let count(B) be the number of subarrays whose elements are all ≤ B; it adds the current run length at each index. The subarrays whose maximum lies in [left, right] number count(right) − count(left − 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'kind' => 'algo',
    'tags' => ['two-pointers', 'arrays', 'counting', 'leetcode'],
    'related_session' => 'number-of-subarrays-with-bounded-maximum',
];
