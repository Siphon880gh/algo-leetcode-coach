<?php
declare(strict_types=1);

return [
    'title' => 'Find Substring With Given Hash Value: roll from the right',
    'leetcode' => 2156,
    'difficulty' => 'Hard',
    'summary' => 'The hash weights s[i] by p^0, so a window starting one step left multiplies the old hash by p and adds the new first letter. Roll windows from the right end to the left (no division needed) and keep the leftmost match.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['sliding-window', 'rolling-hash', 'string', 'leetcode'],
    'related_session' => 'find-substring-with-given-hash-value',
];
