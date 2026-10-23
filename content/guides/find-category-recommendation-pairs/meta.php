<?php
declare(strict_types=1);

return [
    'title' => 'Find Category Recommendation Pairs: distinct user categories, then a self-join',
    'leetcode' => 3554,
    'difficulty' => 'Hard',
    'summary' => 'Reduce purchases to distinct (user, category) rows first. Join that set to itself on user with category1 < category2, count users per pair, keep pairs with at least 3.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['database', 'leetcode'],
    'related_session' => 'find-category-recommendation-pairs',
];
