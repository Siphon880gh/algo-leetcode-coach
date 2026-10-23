<?php
declare(strict_types=1);

return [
    'title' => 'Exclusive Time of Functions',
    'leetcode' => 636,
    'difficulty' => 'Med',
    'summary' => 'Keep a stack of running function ids and the previous timestamp. On "start", charge the elapsed time to the current top, then push. On "end", charge (t − prev + 1) to the top, pop, and set prev = t + 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'tags' => ['stack', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'exclusive-time-of-functions',
    'related_session' => 'exclusive-time-of-functions',
];
