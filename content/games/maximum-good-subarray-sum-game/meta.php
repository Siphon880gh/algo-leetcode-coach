<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Good Subarray Sum',
    'leetcode' => 3026,
    'difficulty' => 'Med',
    'summary' => 'For each value v keep the minimum prefix sum just before an occurrence of v. At index j, check v ± k in that map: sum = prefix[j + 1] − minPrefix. Return the best, or 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-good-subarray-sum',
    'related_session' => 'maximum-good-subarray-sum',
];
