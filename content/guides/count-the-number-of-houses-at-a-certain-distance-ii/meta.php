<?php
declare(strict_types=1);

return [
    'title' => 'Count the Number of Houses at a Certain Distance II: piecewise distances and a difference array',
    'leetcode' => 3017,
    'difficulty' => 'Hard',
    'summary' => 'From house i, the distance to j is the minimum of |i − j|, |i − x| + 1 + |j − y| and |i − y| + 1 + |j − x|. Between the points i, x and y each term is a line of slope ±1, so on each piece the minimum rises then falls (or only one), and each part adds 1 to a contiguous range of distances.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graph', 'prefix-sum', 'leetcode'],
    'related_session' => 'count-the-number-of-houses-at-a-certain-distance-ii',
];
