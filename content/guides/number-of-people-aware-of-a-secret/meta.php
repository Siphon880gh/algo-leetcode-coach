<?php
declare(strict_types=1);

return [
    'title' => 'Number of People Aware of a Secret: new people per day',
    'leetcode' => 2327,
    'difficulty' => 'Med',
    'summary' => 'new[d] counts the people who learn on day d. Everyone who learned on a day in [d − forget + 1, d − delay] shares on day d, so new[d] is that window’s sum. The answer adds new[d] over the last forget days.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'queue', 'simulation', 'leetcode'],
    'related_session' => 'number-of-people-aware-of-a-secret',
];
