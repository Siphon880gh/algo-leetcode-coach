<?php
declare(strict_types=1);

return [
    'title' => 'Movie Rating: two ranked queries joined with UNION ALL',
    'leetcode' => 1341,
    'difficulty' => 'Med',
    'summary' => 'Answer two questions with separate queries: the user with the most ratings (ties by smaller name) and the movie with the highest February 2020 average (ties by smaller title). Stack them with UNION ALL.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'aggregation', 'leetcode'],
    'related_session' => 'movie-rating',
];
