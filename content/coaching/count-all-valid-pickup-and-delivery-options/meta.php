<?php
declare(strict_types=1);

return [
    'title' => 'Count All Valid Pickup and Delivery Options: i · (2i − 1)',
    'leetcode' => 1359,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: add orders one at a time; with 2i − 1 gaps the new pickup and delivery can go in i · (2i − 1) ways, so multiply these. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'related_guide' => 'count-all-valid-pickup-and-delivery-options',
    'tags' => ['math', 'combinatorics', 'step-by-step'],
];
