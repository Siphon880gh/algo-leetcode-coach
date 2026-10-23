<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Substring Matching a*b*c',
    'leetcode' => 3455,
    'difficulty' => 'Hard',
    'summary' => 'Split p into a, b, c around the stars and list all occurrences of each (KMP). For each start of a, binary search the earliest b after it, then the earliest c after that b; the window ends at the end of c.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'shortest-matching-substring',
    'related_session' => 'shortest-matching-substring',
];
