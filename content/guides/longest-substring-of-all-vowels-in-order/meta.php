<?php
declare(strict_types=1);

return [
    'title' => 'Longest Substring Of All Vowels in Order: one pass with a stage counter',
    'leetcode' => 1839,
    'difficulty' => 'Med',
    'summary' => 'Scan once. A drop in letter order restarts the window; a rise moves to the next vowel stage; equal letters extend. Whenever all five stages are present, record the window length.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['sliding-window', 'string', 'leetcode'],
    'related_session' => 'longest-substring-of-all-vowels-in-order',
];
