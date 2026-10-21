<?php
declare(strict_types=1);

return [
    'title' => 'My Calendar I: check the neighbors in sorted order',
    'leetcode' => 729,
    'difficulty' => 'Med',
    'summary' => 'Keep the booked intervals sorted by start. A new [start, end) fits only if the previous booking ends by start and the next booking starts at or after end; binary search finds both.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'binary-search', 'ordered-set', 'intervals', 'leetcode'],
    'related_session' => 'my-calendar-i',
];
