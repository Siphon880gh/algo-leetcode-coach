<?php
declare(strict_types=1);

return [
    'title' => 'Airplane Seat Assignment Probability: one half',
    'leetcode' => 1227,
    'difficulty' => 'Med',
    'summary' => 'The first passenger\'s random choice either lands on seat 1 (everyone fits), seat n (the last loses), or passes the same problem to a later passenger. By symmetry seats 1 and n are equally likely to be taken first, so the answer is 1 for n = 1 and 0.5 otherwise.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'probability', 'dynamic-programming', 'leetcode'],
    'related_session' => 'airplane-seat-assignment-probability',
];
