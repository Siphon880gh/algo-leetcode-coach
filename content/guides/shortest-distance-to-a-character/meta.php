<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Distance to a Character: one pass each way',
    'leetcode' => 821,
    'difficulty' => 'Easy',
    'summary' => 'Sweep left to right, tracking the last position of c, then right to left tracking the next one. Each index keeps the smaller of the two distances.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'kind' => 'algo',
    'tags' => ['two-pointers', 'arrays', 'strings', 'leetcode'],
    'related_session' => 'shortest-distance-to-a-character',
];
