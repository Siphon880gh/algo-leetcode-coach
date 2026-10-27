<?php
declare(strict_types=1);

return [
    'title' => 'Implement Router',
    'leetcode' => 3508,
    'difficulty' => 'Med',
    'summary' => 'Keep packets in a FIFO queue plus a set of (source, destination, timestamp) keys. A duplicate add returns false; a full router drops its oldest packet first. forwardPacket pops the oldest. getCount counts queued packets for one destination with timestamp in [start, end].',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'tags' => ['design', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'implement-router',
    'related_session' => 'implement-router',
];
