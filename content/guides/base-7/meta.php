<?php
declare(strict_types=1);

return [
    'title' => 'Base 7: repeated division by 7, handle sign and zero',
    'leetcode' => 504,
    'difficulty' => 'Easy',
    'summary' => 'Convert num (−1e7 to 1e7) to a base-7 string. Handle 0 → "0". Work with |num|; take num % 7 as the next digit (least significant first), divide by 7, repeat, then reverse and add "−" if negative. 100 → "202". −7 → "−10".',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'strings', 'leetcode'],
    'related_session' => 'base-7',
];
