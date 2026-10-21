<?php
declare(strict_types=1);

return [
    'title' => 'My Calendar II: track bookings and double-booked overlaps',
    'leetcode' => 731,
    'difficulty' => 'Med',
    'summary' => 'Keep two lists: every booking, and the regions already booked twice. Reject a new interval that hits any double-booked region; otherwise add its overlaps with existing bookings to the double list, then add it to the bookings.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'intervals', 'sweep-line', 'leetcode'],
    'related_session' => 'my-calendar-ii',
];
