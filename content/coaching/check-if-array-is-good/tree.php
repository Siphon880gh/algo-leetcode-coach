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
            'message' => "Read the problem statement above.\nDecide with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sorted nums equals base[n]', 'next' => 's2'],
                ['label' => 'max equals length − 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The other values matter; [1, 3, 3, 3] → true instead of false.\nStep back to when you checked only the maximum.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "base[n] contains n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Once, as in 1 … n', 'next' => 'wrong_b'],
                ['label' => 'Twice', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That never matches; example 2 → false instead of true.\nStep back to when you used n once.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → false, true, true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
