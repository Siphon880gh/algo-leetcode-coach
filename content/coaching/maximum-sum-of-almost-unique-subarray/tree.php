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
            'message' => "Read the problem statement above.\nA count drops to 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Delete the key', 'next' => 's2'],
                ['label' => 'Leave it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The distinct count stays high; [1, 2, 2] with m = 2, k = 2 → 4 instead of 3.\nStep back to when you kept the key.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "No window qualifies?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 'wrong_b'],
                ['label' => 'Return 0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement asks for 0; example 3 → −1 instead of 0.\nStep back to when you returned −1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), with 64-bit sums. Examples → 18, 23, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
