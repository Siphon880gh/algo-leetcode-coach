<?php
declare(strict_types=1);

return [
    'title' => 'Abbreviating the Product of a Range: remove the zeros up front',
    'leetcode' => 2117,
    'difficulty' => 'Hard',
    'summary' => 'C = min(count of factor 2, count of factor 5) over the range is the number of trailing zeros. Multiply the range with C twos and C fives removed: keep the exact value while it has at most 10 digits, the last 5 digits mod 10^5, and the leading digits as a scaled float.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'number-theory', 'leetcode'],
    'related_session' => 'abbreviating-the-product-of-a-range',
];
