<?php
declare(strict_types=1);

return [
    'title' => 'Total Score of Dungeon Runs: count starts per room',
    'leetcode' => 3771,
    'difficulty' => 'Med',
    'summary' => 'With prefix damage D, room i scores from start j exactly when hp − (D[i] − D[j − 1]) ≥ req[i], that is D[j − 1] ≥ D[i] + req[i] − hp. D is strictly increasing, so binary search counts the starts.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'prefix-sum', 'leetcode'],
    'related_session' => 'total-score-of-dungeon-runs',
];
