<?php
declare(strict_types=1);

return [
    'title' => 'Delete Columns to Make Sorted II: remember which neighbors are already settled',
    'leetcode' => 955,
    'difficulty' => 'Med',
    'summary' => 'Go column by column. Track which adjacent row pairs are already strictly ordered by kept columns. Delete a column if it puts any unsettled pair out of order; otherwise keep it and mark the pairs it settles.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'strings', 'arrays', 'leetcode'],
    'related_session' => 'delete-columns-to-make-sorted-ii',
];
