<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Make All Characters Equal: pay at every boundary',
    'leetcode' => 2712,
    'difficulty' => 'Med',
    'summary' => 'Each place where neighbours differ must be fixed by one flip ending there, from the left for cost i or from the right for cost n − i. Boundaries are independent, so add the cheaper of the two at each.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['string', 'greedy', 'dynamic-programming', 'leetcode'],
    'related_session' => 'minimum-cost-to-make-all-characters-equal',
];
