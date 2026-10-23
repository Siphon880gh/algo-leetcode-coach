<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Sum of Device Ratings: send every smallest unit to one device',
    'leetcode' => 3961,
    'difficulty' => 'Med',
    'summary' => 'Adding units never raises a rating, and removing the smallest unit lifts a device to its second smallest. So every device gives its smallest unit to one receiver, chosen as the device with the smallest second unit. That device ends at the overall minimum.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['array', 'matrix', 'leetcode'],
    'related_session' => 'maximize-sum-of-device-ratings',
];
