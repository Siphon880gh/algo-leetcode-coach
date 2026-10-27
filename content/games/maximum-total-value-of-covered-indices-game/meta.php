<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Total Value of Covered Indices',
    'leetcode' => 3952,
    'difficulty' => 'Med',
    'summary' => 'Each token covers either its own index or the one before it. Sweep left to right with a DP whose state says whether the current index is already covered by the token to its right moving left; at each token choose stay or move, and never count a cell twice.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-total-value-of-covered-indices',
    'related_session' => 'maximum-total-value-of-covered-indices',
];
