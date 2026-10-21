<?php
declare(strict_types=1);

return [
    'title' => 'Stamping the Sequence: undo stamps in reverse',
    'leetcode' => 936,
    'difficulty' => 'Hard',
    'summary' => 'The last stamp is fully visible, so work backward: find a window that matches the stamp where "?" matches anything and at least one real letter remains, turn it into "?", and record it. When everything is "?", reverse the recorded order.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'strings', 'queue', 'leetcode'],
    'related_session' => 'stamping-the-sequence',
];
