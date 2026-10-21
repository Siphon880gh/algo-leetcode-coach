<?php
declare(strict_types=1);

return [
    'title' => 'Jump Game VII: reachability with a sliding count',
    'leetcode' => 1871,
    'difficulty' => 'Med',
    'summary' => 'Index j is reachable if s[j] is 0 and some reachable index lies in [j − maxJump, j − minJump]. Keep a running count of reachable indices in that window as it slides.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['sliding-window', 'prefix-sum', 'dynamic-programming', 'leetcode'],
    'related_session' => 'jump-game-vii',
];
