<?php
declare(strict_types=1);

return [
    'title' => 'Next Closest Time: try every time built from the four digits',
    'leetcode' => 681,
    'difficulty' => 'Med',
    'summary' => 'There are only 4⁴ = 256 candidate strings. Keep the valid ones (hour < 24, minute < 60), measure minutes forward from the input, wrapping at 1440, and take the smallest positive gap.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'kind' => 'algo',
    'tags' => ['strings', 'enumeration', 'leetcode'],
    'related_session' => 'next-closest-time',
];
