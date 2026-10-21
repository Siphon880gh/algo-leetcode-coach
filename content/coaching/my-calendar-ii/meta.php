<?php
declare(strict_types=1);

return [
    'title' => 'My Calendar II: reject on a double overlap',
    'leetcode' => 731,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: check the new interval against the doubled regions first, then record its overlaps with bookings, then book it. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'related_guide' => 'my-calendar-ii',
    'tags' => ['design', 'intervals', 'sweep-line', 'step-by-step'],
];
