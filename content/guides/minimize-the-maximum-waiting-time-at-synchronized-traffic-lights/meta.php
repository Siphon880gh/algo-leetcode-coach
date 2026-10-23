<?php
declare(strict_types=1);

return [
    'title' => 'Minimize the Maximum Waiting Time at Synchronized Traffic Lights: use the longest green',
    'leetcode' => 4025,
    'difficulty' => 'Med',
    'summary' => 'Send every car to the light with the longest green phase mx. A car with r = arrival mod period below mx waits 0; a car with r ≥ mx waits period − r at every light.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'leetcode'],
    'related_session' => 'minimize-the-maximum-waiting-time-at-synchronized-traffic-lights',
];
