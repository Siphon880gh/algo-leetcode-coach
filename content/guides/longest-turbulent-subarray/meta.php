<?php
declare(strict_types=1);

return [
    'title' => 'Longest Turbulent Subarray: two running lengths',
    'leetcode' => 978,
    'difficulty' => 'Med',
    'summary' => 'Track the longest turbulent run ending at i that ends with a rise (inc) and with a fall (dec). A rise extends a run that ended with a fall, and vice versa; equal neighbors reset both.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'sliding-window', 'arrays', 'leetcode'],
    'related_session' => 'longest-turbulent-subarray',
];
