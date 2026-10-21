<?php
declare(strict_types=1);

return [
    'title' => 'Closest Room: offline queries by size',
    'leetcode' => 1847,
    'difficulty' => 'Hard',
    'summary' => 'Sort rooms and queries by size descending. Sweep queries, inserting every room with size ≥ the query\'s minimum into a sorted list of ids; binary search the preferred id and compare its two neighbours (smaller id on ties).',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['binary-search', 'sorting', 'ordered-set', 'leetcode'],
    'related_session' => 'closest-room',
];
