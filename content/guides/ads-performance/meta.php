<?php
declare(strict_types=1);

return [
    'title' => 'Ads Performance: click-through rate per ad',
    'leetcode' => 1322,
    'difficulty' => 'Easy',
    'summary' => 'Group by ad and use conditional sums for clicks and views. Guard the zero denominator with a CASE (or IFNULL) so ads with only ignores still appear with rate 0.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'aggregation', 'leetcode'],
    'related_session' => 'ads-performance',
];
