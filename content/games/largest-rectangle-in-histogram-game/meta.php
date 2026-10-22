<?php
declare(strict_types=1);

return [
    'title' => 'Largest Rectangle in Histogram: a shorter bar settles taller ones',
    'leetcode' => 84,
    'difficulty' => 'Hard',
    'summary' => 'Keep bar indexes with increasing heights. A shorter bar pops each taller bar; that bar\'s rectangle spans from the new top + 1 to i − 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'tags' => ['mono-stack', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'largest-rectangle-in-histogram',
    'related_session' => 'largest-rectangle-in-histogram',
];
