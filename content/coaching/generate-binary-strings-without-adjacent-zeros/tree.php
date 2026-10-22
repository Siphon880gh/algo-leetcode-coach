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
            'message' => "Read the problem statement above.\n0 may go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At the start or after a 1', 'next' => 's2'],
                ['label' => 'Only after a 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 loses 010 and 011, and example 2 loses 0.\nStep back to when you banned a leading 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Bitmask filter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'm AND (m >> 1) = 0', 'next' => 'wrong_b'],
                ['label' => 'No two adjacent zero bits in the n-bit string', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That forbids adjacent 1s: n = 3 → 000, 001, 010, 100, 101.\nStep back to when you used that test.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · F(n + 2)). Examples → 5 strings, 2 strings.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
