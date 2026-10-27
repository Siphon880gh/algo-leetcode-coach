<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Balanced Shipments',
    'leetcode' => 3638,
    'difficulty' => 'Med',
    'summary' => 'Greedy: close a shipment as soon as possible. Track the max weight since the last cut; the first parcel lighter than that max ends a balanced shipment, so count it and start fresh.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-balanced-shipments',
    'related_session' => 'maximum-balanced-shipments',
];
