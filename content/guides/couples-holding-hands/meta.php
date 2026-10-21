<?php
declare(strict_types=1);

return [
    'title' => 'Couples Holding Hands: fix each seat pair greedily',
    'leetcode' => 765,
    'difficulty' => 'Hard',
    'summary' => 'Look at seats in pairs (0,1), (2,3), …. If the person in the second seat is not the partner of the first (partner = x ^ 1), swap the partner in from wherever they sit. A position map makes each swap O(1), and greedy is optimal.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'union-find', 'graphs', 'arrays', 'leetcode'],
    'related_session' => 'couples-holding-hands',
];
