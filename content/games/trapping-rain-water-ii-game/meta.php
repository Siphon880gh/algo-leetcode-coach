<?php
declare(strict_types=1);

return [
    'title' => 'Trapping Rain Water II',
    'leetcode' => 407,
    'difficulty' => 'Hard',
    'summary' => 'Push all border cells into a min-heap. Repeatedly pop the lowest wall, visit its unvisited neighbors: water there = max(0, wall − height); push the neighbor with height max(wall, height).',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'tags' => ['heap', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'trapping-rain-water-ii',
    'related_session' => 'trapping-rain-water-ii',
];
