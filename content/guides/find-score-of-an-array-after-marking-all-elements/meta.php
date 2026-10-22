<?php
declare(strict_types=1);

return [
    'title' => 'Find Score of an Array After Marking All Elements: sorted order, skip marked',
    'leetcode' => 2593,
    'difficulty' => 'Med',
    'summary' => 'The chosen element is always the smallest unmarked one, with ties by index. Visit indices sorted by (value, index); add each unmarked one and mark it and its neighbours.',
    'category' => 'LeetCode',
    'subcategory' => 'Sorting',
    'topic' => 'LeetCode · Sorting',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'sorting', 'heap', 'simulation', 'leetcode'],
    'related_session' => 'find-score-of-an-array-after-marking-all-elements',
];
