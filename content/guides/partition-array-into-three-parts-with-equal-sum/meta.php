<?php
declare(strict_types=1);

return [
    'title' => 'Partition Array Into Three Parts With Equal Sum: count prefix hits',
    'leetcode' => 1013,
    'difficulty' => 'Easy',
    'summary' => 'The total must be divisible by 3. Scan with a running sum; each time it reaches total / 3, count a part and reset. Three or more parts means the rest can be folded into the third.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'arrays', 'prefix-sum', 'leetcode'],
    'related_session' => 'partition-array-into-three-parts-with-equal-sum',
];
