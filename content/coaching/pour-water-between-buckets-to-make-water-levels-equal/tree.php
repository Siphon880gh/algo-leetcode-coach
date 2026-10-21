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
            'message' => "Problem: You are given buckets, where buckets[i] is the water in the i-th bucket, and an integer loss (a percentage). Pouring k gallons from one bucket to another spills loss percent of k, so the receiver gets k · (1 − loss / 100). Return the maximum level all buckets can reach equally, within the tolerance the statement gives. For instance, [1,2,7] with loss 80 → 2.0; [2,4,6] with loss 50 → 3.5; [3,3,3,3] with loss 40 → 3.0. (Restated from memory; limits and examples may differ slightly.)\nIs level x feasible when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Excess above x times (1 − loss / 100) covers the shortfall', 'next' => 's2'],
                ['label' => 'Excess covers the shortfall times (1 − loss / 100)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The spill reduces what arrives, not what is needed; [1,2,7] with loss 80 would give about 5.43 instead of 2.0.\nStep back to when you applied the loss to the shortfall.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why does binary search work?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It does not; try each bucket level', 'next' => 'wrong_b'],
                ['label' => 'Raising x lowers supply and raises demand', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Feasibility flips exactly once as x grows.\nStep back to when you abandoned the search.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Search over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Real numbers until the tolerance', 'next' => 'success'],
                ['label' => 'Integers only', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. [2,4,6] with loss 50 → 3.5.\nStep back to when you searched integers.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · iterations). Constructed checks → 2.0, 3.5, 3.0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
