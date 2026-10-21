<?php
declare(strict_types=1);

return [
    'title' => 'Falling Squares: the max height under each new square',
    'leetcode' => 699,
    'difficulty' => 'Hard',
    'summary' => 'A square lands on the tallest thing beneath its span, so its top is that height plus its side. Check every earlier square for overlap (O(n²)), or use a segment tree with range max and range assign over compressed coordinates.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'kind' => 'algo',
    'tags' => ['segment-tree', 'arrays', 'coordinate-compression', 'leetcode'],
    'related_session' => 'falling-squares',
];
