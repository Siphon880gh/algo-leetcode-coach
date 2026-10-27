<?php
declare(strict_types=1);

return [
    'title' => 'Generate Schedule',
    'leetcode' => 3680,
    'difficulty' => 'Med',
    'summary' => 'Each ordered pair plays once (n(n−1) days) and nobody plays two days in a row, which is impossible for n at most 4. For larger n, build greedily: each day pick a remaining match between two teams that did not play yesterday, preferring teams with the most matches left; restart with a different tie-break if stuck.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'generate-schedule',
    'related_session' => 'generate-schedule',
];
