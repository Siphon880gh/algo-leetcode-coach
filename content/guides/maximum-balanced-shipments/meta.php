<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Balanced Shipments: close a shipment as soon as you can',
    'leetcode' => 3638,
    'difficulty' => 'Med',
    'summary' => 'Scan left to right with the maximum of the current shipment. The first parcel lighter than that maximum closes a balanced shipment; closing it as early as possible leaves the most parcels for later. Then start a new shipment.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['stack', 'greedy', 'array', 'dynamic-programming', 'monotonic-stack', 'leetcode'],
    'related_session' => 'maximum-balanced-shipments',
];
