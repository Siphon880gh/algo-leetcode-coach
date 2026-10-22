<?php
declare(strict_types=1);

return [
    'title' => 'Find the String with LCP: greedy letters, then recheck',
    'leetcode' => 2573,
    'difficulty' => 'Hard',
    'summary' => 'lcp[i][j] > 0 means the letters at i and j are equal. Give each new position the next unused letter and copy it to every later j with lcp[i][j] > 0. Then rebuild the lcp matrix from that string and compare.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['array', 'string', 'dynamic-programming', 'greedy', 'matrix', 'union-find', 'leetcode'],
    'related_session' => 'find-the-string-with-lcp',
];
