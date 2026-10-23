<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Subarrays After Removing One Conflicting Pair: two largest left ends',
    'leetcode' => 3480,
    'difficulty' => 'Hard',
    'summary' => 'Write each pair as a < b. For right end r, a subarray [l, r] is valid when l is greater than the largest a among pairs with b ≤ r, so r − max1 subarrays end at r. Removing the pair holding max1 would add max1 − max2 there; credit that gain to the pair.',
    'category' => 'LeetCode',
    'subcategory' => 'Enumeration',
    'topic' => 'LeetCode · Enumeration',
    'kind' => 'algo',
    'tags' => ['segment-tree', 'array', 'enumeration', 'prefix-sum', 'leetcode'],
    'related_session' => 'maximize-subarrays-after-removing-one-conflicting-pair',
];
