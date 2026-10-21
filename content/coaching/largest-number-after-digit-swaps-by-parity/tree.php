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
            'message' => "Read the problem statement above.\nWhich swaps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Digits of the same parity', 'next' => 's2'],
                ['label' => 'Any two digits', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 4321 instead of 3412.\nStep back to when you sorted all digits.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Refill positions?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All odd digits first, then even ones', 'next' => 'wrong_b'],
                ['label' => 'Each position from its original digit’s parity list', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 1234 would become 3142, moving parities to new positions.\nStep back to when you regrouped the digits.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Parity of what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Of the digit value', 'next' => 'success'],
                ['label' => 'Of the position', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 247 → 427 by digit parity, but swapping positions 0 and 2 would give 742.\nStep back to when you used positions.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(d log d). Examples → 3412, 87655.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
