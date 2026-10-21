<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Distance to Target Color: nearest from both sides',
    'leetcode' => 1182,
    'difficulty' => 'Med',
    'summary' => 'For each of the three colors, sweep left to right recording the distance to the last occurrence, and right to left for the next one. Each query is the smaller of the two, or −1.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'arrays', 'binary-search', 'leetcode'],
    'related_session' => 'shortest-distance-to-target-color',
];
