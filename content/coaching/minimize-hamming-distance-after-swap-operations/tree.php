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
            'message' => "Read the problem statement above.\nWhat can swaps reach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any permutation inside a connected component', 'next' => 's2'],
                ['label' => 'Only the listed pairs once each', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Swaps compose; any arrangement in a component is reachable.\nStep back to when you used each pair once.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Per-component data?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A sorted list compared index by index', 'next' => 'wrong_b'],
                ['label' => 'A counter of source values', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Matching is by value multiset, not position.\nStep back to when you compared sorted lists.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A target value not available?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count one mismatch', 'next' => 'success'],
                ['label' => 'Borrow from another component', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Values cannot cross component boundaries.\nStep back to when you borrowed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n α(n) + swaps). Examples → 1, 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
