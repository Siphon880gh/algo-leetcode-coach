<?php
declare(strict_types=1);

return [
    'title' => 'Last Day Where You Can Still Cross: binary search on the day',
    'leetcode' => 1970,
    'difficulty' => 'Hard',
    'summary' => 'Crossing possible on day d implies possible on earlier days. Binary search d, flooding the first d cells and BFS from the top row. Alternatively, union-find in reverse (un-flooding cells) until top and bottom connect.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['binary-search', 'bfs', 'union-find', 'matrix', 'leetcode'],
    'related_session' => 'last-day-where-you-can-still-cross',
];
