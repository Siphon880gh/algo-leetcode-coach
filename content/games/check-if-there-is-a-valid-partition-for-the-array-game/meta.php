<?php
declare(strict_types=1);

return [
    'title' => 'Valid Partition: blocks of 2 equal, 3 equal, or 3 consecutive',
    'leetcode' => 2369,
    'difficulty' => 'Med',
    'summary' => 'ok[i] = the first i numbers can be partitioned. ok[i] = (ok[i−2] and last two equal) or (ok[i−3] and last three equal or consecutive increasing).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'check-if-there-is-a-valid-partition-for-the-array',
    'related_session' => 'check-if-there-is-a-valid-partition-for-the-array',
];
