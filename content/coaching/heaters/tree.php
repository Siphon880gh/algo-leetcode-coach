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
                ['label' => 'For each house, find its nearest heater; the answer is the largest of those distances', 'next' => 's2'],
                ['label' => 'For each house, check the distance to every heater', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Comparing every house with every heater is 9e8 checks, too slow.\nStep back to when you compared all pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sort heaters. Binary search for the first heater at or after the house.\nWhich heaters can be nearest?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only that heater (the first one at or after the house)', 'next' => 'wrong_b'],
                ['label' => 'That heater and the one just before it; take the closer', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The heater just before the house can be closer. House 5 with heaters [2, 9]: right is 4 away, left is 3.\nStep back to when you only used the right neighbor.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Missing neighbors (house past either end) use the one that exists. O((m + n) log n). Binary search on r with a greedy check also works.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Max over houses of distance to nearest heater (both neighbors)', 'next' => 'success'],
                ['label' => 'Average the nearest distances', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every house must be covered, so the radius is set by the worst house, not the average.\nStep back to when you averaged.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Nearest heater per house via binary search with both neighbors, then the max. [1,5], [2] → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
