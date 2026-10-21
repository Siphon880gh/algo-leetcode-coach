<?php
declare(strict_types=1);

return [
    'title' => 'Reorganize String: fill even slots with the most frequent letter first',
    'leetcode' => 767,
    'difficulty' => 'Med',
    'summary' => 'If some letter occurs more than ceil(n / 2) times, no arrangement exists. Otherwise place letters in order of decreasing count into indexes 0, 2, 4, …, then 1, 3, 5, …; equal letters never land next to each other.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'heap', 'counting', 'strings', 'leetcode'],
    'related_session' => 'reorganize-string',
];
