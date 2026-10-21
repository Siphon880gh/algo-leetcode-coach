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
            'message' => "Read the problem statement above.\nWhat needs to be chosen?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the first two numbers; the rest is forced', 'next' => 's2'],
                ['label' => 'Every split point', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Once two numbers are fixed, each next one must be their sum.\nStep back to when you tried every split.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A piece is \"05\". Valid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, it is 5', 'next' => 'wrong_b'],
                ['label' => 'No: only "0" itself may start with 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Leading zeros are not allowed.\nStep back to when you accepted 05.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A piece exceeds 2³¹ − 1. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop: it cannot be used', 'next' => 'success'],
                ['label' => 'Keep going', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every number must fit in a 32-bit signed integer.\nStep back to when you ignored the bound.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²) choices, each checked in O(n). \"1101111\" → [11,0,11,11] (or [110,1,111]). \"112358130\" → []. \"0123\" → [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
