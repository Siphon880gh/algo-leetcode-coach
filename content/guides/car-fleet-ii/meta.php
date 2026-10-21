<?php
declare(strict_types=1);

return [
    'title' => 'Car Fleet II: monotonic stack from the right',
    'leetcode' => 1776,
    'difficulty' => 'Hard',
    'summary' => 'Process cars right to left with a stack of candidates ahead. Pop a car if the current one is not faster, or if it would catch it only after that car has already merged into its own fleet. The new top gives the collision time.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'kind' => 'algo',
    'tags' => ['monotonic-stack', 'math', 'array', 'leetcode'],
    'related_session' => 'car-fleet-ii',
];
