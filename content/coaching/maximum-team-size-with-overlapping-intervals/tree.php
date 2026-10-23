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
            'message' => "Problem: You get the start and end times of n employees’ work intervals. A team is valid when some member’s interval overlaps the interval of every other member. Return the largest possible team size. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nTouching endpoints?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'They overlap', 'next' => 's2'],
                ['label' => 'They do not', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): starts [1, 5], ends [5, 9] → 1 instead of 2.\nStep back to when you made the ends exclusive.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Overlaps for [l, r]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n − (ends < l)', 'next' => 'wrong_b'],
                ['label' => 'n − (ends < l) − (starts > r)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): starts [1, 2, 6, 3], ends [4, 3, 8, 5] → 4 instead of 3.\nStep back to when you kept intervals that start after r.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed checks → 3, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
