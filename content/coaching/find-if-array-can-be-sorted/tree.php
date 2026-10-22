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
            'message' => "Read the problem statement above.\nValues can move within?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Their run of equal popcount', 'next' => 's2'],
                ['label' => 'All values with that popcount', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A value cannot pass a different popcount; [4, 3, 2] → true instead of false.\nStep back to when you grouped across runs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Run order works when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each run is already sorted', 'next' => 'wrong_b'],
                ['label' => 'Each run’s min ≥ previous run’s max', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Runs can be sorted in place; example 1 → false instead of true.\nStep back to when you required sorted runs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
