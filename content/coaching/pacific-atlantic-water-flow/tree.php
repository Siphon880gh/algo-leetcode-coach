<?php
declare(strict_types=1);

/**
 * Step-by-step tree contract:
 * - start: node id
 * - nodes[id]: message, outcome (continue|wrong|success), choices[{label, next}], optional rewind_to on wrong
 */
return [
    'start' => 'start',
    'nodes' => [
        'start' => [
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'From every cell, DFS downhill and check which oceans it hits', 'next' => 'wrong_forward'],
                ['label' => 'Reverse it: search inland from each ocean border, walking uphill', 'next' => 'reverse'],
            ],
        ],
        'wrong_forward' => [
            'message' => "You are wrong here. A fresh downhill search per cell repeats work: up to (m n)² steps on a 200 by 200 grid. Caching per cell is tricky because flat plateaus create cycles.\nStep back to when you searched from every cell.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'reverse' => [
            'message' => "Seed one queue with every Pacific border cell (row 0 and column 0), another with every Atlantic border cell (last row and last column). BFS or DFS from each.\nWhen may the search step from cell a to neighbor b?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When height[b] < height[a] (keep going downhill)', 'next' => 'wrong_edge'],
                ['label' => 'When height[b] >= height[a] (water could flow b → a)', 'next' => 'meet'],
            ],
        ],
        'wrong_edge' => [
            'message' => "You are wrong. You are walking the flow backwards, so the neighbor must be at least as high: water on b could then run down into a and on to the ocean. Strictly less also drops equal-height plateaus that do drain.\nStep back to when you chose the edge rule.",
            'outcome' => 'wrong',
            'rewind_to' => 'reverse',
            'choices' => [],
        ],
        'meet' => [
            'message' => "Mark visited in two grids, pac and atl. A cell in both can drain to both oceans. Each cell is visited at most once per ocean: O(m n) time, O(m n) space. Number of Islands (200) counts land; Surrounded Regions (130) flips enclosed O.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two uphill searches from the borders, return pac ∩ atl. Not 200 / 130', 'next' => 'success'],
                ['label' => 'Return cells reached by either ocean (the union)', 'next' => 'wrong_union'],
            ],
        ],
        'wrong_union' => [
            'message' => "You are wrong. The question asks for cells that reach both oceans, so you need the intersection. The union would include every border cell.\nStep back to when you combined the two visited grids.",
            'outcome' => 'wrong',
            'rewind_to' => 'meet',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Reverse the flow: seed each ocean border, walk to neighbors at least as high, intersect the two visited sets. O(m n) time and space. [[1]] → [[0,0]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
