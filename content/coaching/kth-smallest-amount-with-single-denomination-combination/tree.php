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
            'message' => "Read the problem statement above.\nAmounts ≤ x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Inclusion–exclusion over coin subsets', 'next' => 's2'],
                ['label' => 'Σ ⌊x / c⌋ over coins', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Shared multiples count twice: example 1 → 6 and example 2 → 10.\nStep back to when you added per coin.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Find the k-th how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pop multiples in order from a heap', 'next' => 'wrong_b'],
                ['label' => 'Binary search on x', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That pops k values, up to 2 · 10^9.\nStep back to when you used the heap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2^c · log(range)); use 64-bit. Examples → 9, 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
