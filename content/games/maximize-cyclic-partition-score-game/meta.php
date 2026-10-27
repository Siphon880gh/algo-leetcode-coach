<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Cyclic Partition Score',
    'leetcode' => 3743,
    'difficulty' => 'Hard',
    'summary' => 'Choose where the cycle is cut, then run a linear DP: best[j][p] = best score splitting the first j elements into p pieces, adding max − min of the last piece. (The real solution avoids trying every cut by tracking open "max" and "min" picks.)',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximize-cyclic-partition-score',
    'related_session' => 'maximize-cyclic-partition-score',
];
