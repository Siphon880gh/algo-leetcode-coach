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
            'message' => "Read the problem statement above.\nGroup letters by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Index parity', 'next' => 's2'],
                ['label' => 'Nothing, compare all letters', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Letters never change parity; example 2 → true instead of false.\nStep back to when you pooled them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Within a parity?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Positions must already match', 'next' => 'wrong_b'],
                ['label' => 'Any order works', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Swaps reorder each parity; example 1 → false instead of true.\nStep back to when you compared positions.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
