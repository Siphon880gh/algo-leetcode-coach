<?php
declare(strict_types=1);

return [
    'title' => 'Count Integers in Intervals: merge into a sorted set of disjoint ranges',
    'leetcode' => 2276,
    'difficulty' => 'Hard',
    'summary' => 'Keep disjoint intervals sorted by start with a running total. add removes every stored interval that overlaps [left, right], widens the new one to cover them, inserts it and updates the total; count returns the total.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'segment-tree', 'ordered-set', 'leetcode'],
    'related_session' => 'count-integers-in-intervals',
];
