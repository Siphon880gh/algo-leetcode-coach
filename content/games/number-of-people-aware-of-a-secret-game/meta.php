<?php
declare(strict_types=1);

return [
    'title' => 'Number of People Aware of a Secret: new learners per day',
    'leetcode' => 2327,
    'difficulty' => 'Med',
    'summary' => 'new[d] = number of people who learn on day d = Σ new[j] for j in [d − forget + 1, d − delay] (those currently sharing). Aware on day n = Σ new over the last forget days.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-people-aware-of-a-secret',
    'related_session' => 'number-of-people-aware-of-a-secret',
];
