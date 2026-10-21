<?php
declare(strict_types=1);

return [
    'title' => 'Dota2 Senate: two queues of turn order',
    'leetcode' => 649,
    'difficulty' => 'Med',
    'summary' => 'Keep a queue of indexes for each party. Each round the earlier senator bans the other and rejoins at index + n for the next round; the party whose queue empties loses.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'queue', 'simulation', 'strings', 'leetcode'],
    'related_session' => 'dota2-senate',
];
