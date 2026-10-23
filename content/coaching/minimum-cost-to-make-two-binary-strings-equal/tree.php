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
            'message' => "Read the problem statement above.\nA swap inside one string fixes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One mismatch of each type', 'next' => 's2'],
                ['label' => 'Any two mismatches', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 14 instead of 16.\nStep back to when you paired any two.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Plans to try?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Flip all and pair-swap only', 'next' => 'wrong_b'],
                ['label' => 'Flip all, pair-swap, cross-then-swap', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 32 instead of 16.\nStep back to when you skipped cross swaps.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 16, 6, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
