<?php
declare(strict_types=1);

return [
    'title' => 'Car Fleet: sort by position, compare arrival times',
    'leetcode' => 853,
    'difficulty' => 'Med',
    'summary' => 'Process cars from the one nearest the target backward. Each car\'s solo arrival time is (target − position) / speed; it starts a new fleet only when it would arrive later than the fleet ahead.',
    'category' => 'LeetCode',
    'subcategory' => 'Sorting',
    'topic' => 'LeetCode · Sorting',
    'kind' => 'algo',
    'tags' => ['sorting', 'monotonic-stack', 'arrays', 'leetcode'],
    'related_session' => 'car-fleet',
];
