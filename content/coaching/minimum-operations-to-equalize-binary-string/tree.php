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
            'message' => "Read the problem statement above.\nIs ⌈z / k⌉ enough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No; check parity and caps for each t', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 1 instead of 2.\nStep back to when you divided.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cap flips per position?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No cap', 'next' => 'wrong_b'],
                ['label' => 'Yes: at most t, with the right parity', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. \"001\", k = 3 → 2 instead of −1.\nStep back to when you dropped the cap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 2, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
