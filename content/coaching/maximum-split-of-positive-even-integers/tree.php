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
            'message' => "Read the problem statement above.\nfinalSum is odd?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return []', 'next' => 's2'],
                ['label' => 'Split it anyway', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Even numbers always sum to an even total; Example 2 (7) → [].\nStep back to when you tried to split it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which evens first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest that fits', 'next' => 'wrong_b'],
                ['label' => 'The smallest: 2, 4, 6, …', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 12 → [12], one number instead of three.\nStep back to when you took the largest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Remainder after 2, 4, 6, …?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add it to the last number', 'next' => 'success'],
                ['label' => 'Append it as a new number', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 28 → 2 + 4 + 6 + 8 leaves 8, which would repeat 8.\nStep back to when you appended the remainder.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(√finalSum). Examples → [2,4,6], [], a 4-number split of 28.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
