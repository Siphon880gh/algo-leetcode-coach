<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Manhattan Distance After K Changes: four diagonal directions per prefix',
    'leetcode' => 3443,
    'difficulty' => 'Med',
    'summary' => 'Fix one of the four diagonal directions, such as north-east. In a prefix with g moves toward it and b against it, changing min(k, b) bad moves gives g − b + 2 · min(k, b). Take the best over every prefix and direction.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['hash-table', 'math', 'string', 'counting', 'leetcode'],
    'related_session' => 'maximum-manhattan-distance-after-k-changes',
];
