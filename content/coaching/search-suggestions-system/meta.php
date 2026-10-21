<?php
declare(strict_types=1);

return [
    'title' => 'Search Suggestions System: sort and binary search each prefix',
    'leetcode' => 1268,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: sort the products, and for each prefix of the search word binary search the first product at or after it, then take up to three that start with the prefix. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'related_guide' => 'search-suggestions-system',
    'tags' => ['binary-search', 'sorting', 'strings', 'trie', 'step-by-step'],
];
