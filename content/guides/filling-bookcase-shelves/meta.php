<?php
declare(strict_types=1);

return [
    'title' => 'Filling Bookcase Shelves: DP on the last shelf',
    'leetcode' => 1105,
    'difficulty' => 'Med',
    'summary' => 'Books go in order, so the last shelf holds a suffix of the books placed so far. dp[i] tries every last shelf ending at book i while the width fits, adding the tallest book on it.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'arrays', 'leetcode'],
    'related_session' => 'filling-bookcase-shelves',
];
