<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Sum of Device Ratings',
    'leetcode' => 3961,
    'difficulty' => 'Med',
    'summary' => 'Adding a unit never raises a device\'s minimum, and removing helps only if you remove the minimum unit. So each device either keeps its rating, or donates its minimum unit (rating rises to its second-smallest) and the gift lowers the receiver to min(rating, gift). Choose which devices donate and where each gift lands to maximise the total.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximize-sum-of-device-ratings',
    'related_session' => 'maximize-sum-of-device-ratings',
];
