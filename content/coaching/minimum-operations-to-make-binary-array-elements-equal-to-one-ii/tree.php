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
            'message' => "Read the problem statement above.\nFlip at x when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x XOR parity = 0', 'next' => 's2'],
                ['label' => 'x = 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Earlier flips change what x reads: example 1 → 2 instead of 4.\nStep back to when you tested the raw value.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After a flip?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Rewrite every later value', 'next' => 'wrong_b'],
                ['label' => 'Toggle the parity', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Alternating input then needs about 5 · 10^9 writes at n = 10^5.\nStep back to when you rewrote the suffix.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 4, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
