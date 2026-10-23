<?php
declare(strict_types=1);

return [
    'title' => 'Min Difference After Three Moves: drop 3 from the ends',
    'leetcode' => 1509,
    'difficulty' => 'Med',
    'summary' => 'With n ≤ 4 the answer is 0. Otherwise sort and try removing i from the bottom and 3 − i from the top: min over a[n−4+i] − a[i].',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-difference-between-largest-and-smallest-value-in-three-moves',
    'related_session' => 'minimum-difference-between-largest-and-smallest-value-in-three-moves',
];
