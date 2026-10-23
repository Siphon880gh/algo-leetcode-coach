<?php
declare(strict_types=1);

return [
    'title' => 'Widest Possible Fence: count every reachable height',
    'leetcode' => 4007,
    'difficulty' => 'Hard',
    'summary' => 'For a height h, the planks you can make are the planks of height h, plus pairs (x, h − x). Different heights x use different planks, so they add up: min(cnt[x], cnt[h − x]) for x < h − x, and ⌊cnt[h/2] / 2⌋.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'counting', 'enumeration', 'leetcode'],
    'related_session' => 'widest-possible-fence',
];
