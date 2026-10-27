<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Points Activated With One Addition',
    'leetcode' => 3873,
    'difficulty' => 'Hard',
    'summary' => 'Union each point\'s x-line with its y-line in a DSU over coordinates; each component is one activation group. A new point (x from one group, y from another) links two groups, so the answer is the two largest group sizes plus 1 (one group plus 1 if there is only one).',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'tags' => ['union-find', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-points-activated-with-one-addition',
    'related_session' => 'maximum-points-activated-with-one-addition',
];
