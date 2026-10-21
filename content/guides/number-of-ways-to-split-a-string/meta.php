<?php
declare(strict_types=1);

return [
    'title' => 'Number of Ways to Split a String: zeros between ones',
    'leetcode' => 1573,
    'difficulty' => 'Med',
    'summary' => 'Each part needs total/3 ones. With no ones, choose 2 cut points among n − 1 gaps. Otherwise the first cut can sit anywhere in the zero gap after the k-th one, and the second in the gap after the 2k-th one.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'strings', 'leetcode'],
    'related_session' => 'number-of-ways-to-split-a-string',
];
