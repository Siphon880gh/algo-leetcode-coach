<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Time Takes to Reach Destination Without Drowning: arrive before the water',
    'leetcode' => 2814,
    'difficulty' => 'Hard',
    'summary' => 'First BFS the flood to get the second each cell goes under. Then BFS from the start, entering a cell only if you get there before it floods.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['array', 'breadth-first-search', 'matrix', 'leetcode'],
    'related_session' => 'minimum-time-takes-to-reach-destination-without-drowning',
];
