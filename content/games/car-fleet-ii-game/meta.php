<?php
declare(strict_types=1);

return [
    'title' => 'Car Fleet II',
    'leetcode' => 1776,
    'difficulty' => 'Hard',
    'summary' => 'Process cars from the back with a stack of candidates ahead. Pop a car if it is not slower than us, or if it collides (joins a fleet) before we would reach it. The top then gives our collision time.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'tags' => ['mono-stack', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'car-fleet-ii',
    'related_session' => 'car-fleet-ii',
];
