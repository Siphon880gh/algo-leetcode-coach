<?php
declare(strict_types=1);

return [
    'title' => 'Reconstruct Itinerary (Hierholzer)',
    'leetcode' => 332,
    'difficulty' => 'Hard',
    'summary' => 'Sort each airport\'s destinations. DFS from JFK always taking the smallest unused ticket; append an airport after its tickets run out, then reverse. This gives the lexically smallest Eulerian path.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'reconstruct-itinerary',
    'related_session' => 'reconstruct-itinerary',
];
