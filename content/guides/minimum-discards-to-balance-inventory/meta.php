<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Discards to Balance Inventory: keep whenever allowed',
    'leetcode' => 3679,
    'difficulty' => 'Med',
    'summary' => 'Keeping an arrival never hurts later days more than discarding it would help, so keep it unless its type already has m kept copies in the last w days. Track kept counts in a sliding window.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'counting', 'sliding-window', 'simulation', 'leetcode'],
    'related_session' => 'minimum-discards-to-balance-inventory',
];
