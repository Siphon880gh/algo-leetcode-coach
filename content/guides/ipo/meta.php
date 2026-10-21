<?php
declare(strict_types=1);

return [
    'title' => 'IPO: unlock affordable projects by capital, take the most profitable each round',
    'leetcode' => 502,
    'difficulty' => 'Hard',
    'summary' => 'Start with capital w and do at most k projects; a project needs capital[i] to start and adds profits[i]. Sort projects by capital (or a min-heap). Each round, push every project you can now afford into a max-heap of profits, then take the top. Stop early if none is affordable. k = 2, w = 0, [1,2,3], [0,1,1] → 4.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['heap', 'greedy', 'sorting', 'leetcode'],
    'related_session' => 'ipo',
];
