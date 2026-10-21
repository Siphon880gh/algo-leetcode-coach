<?php
declare(strict_types=1);

return [
    'title' => 'Dota2 Senate: two queues and index + n',
    'leetcode' => 649,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: a queue of indexes per party, the earlier index bans the other, and the winner rejoins at index + n. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'dota2-senate',
    'tags' => ['greedy', 'queue', 'simulation', 'strings', 'step-by-step'],
];
