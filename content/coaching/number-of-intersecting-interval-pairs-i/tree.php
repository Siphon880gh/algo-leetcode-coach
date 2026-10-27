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
            'message' => "Read the problem statement above.\nDo [1, 2] and [2, 3] intersect?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, they only touch', 'next' => 'wrong_a'],
                ['label' => 'Yes, they share the point 2', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Closed intervals that share an endpoint intersect. Treating touching as disjoint gives 0 instead of 2.\nStep back to when you split touching intervals.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "For a start s, which intervals are disjoint from it and earlier?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Intervals whose end is strictly less than s', 'next' => 'success'],
                ['label' => 'Intervals whose start is less than s', 'next' => 'wrong_b'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1, 5] starts before 3 but overlaps [3, 6]. Counting earlier starts gives 0 instead of 3 for Example 2.\nStep back to when you compared starts.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Total pairs minus a sorted sweep of disjoint pairs. O(n log n). Examples give 2, 3 and 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
