<?php
declare(strict_types=1);

return [
    'title' => 'Movie Rating: two LIMIT 1 queries',
    'leetcode' => 1341,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: find the user with the most ratings (ties by name) and the February 2020 movie with the best average (ties by title), and stack them with UNION ALL. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'movie-rating',
    'tags' => ['sql', 'aggregation', 'step-by-step'],
];
