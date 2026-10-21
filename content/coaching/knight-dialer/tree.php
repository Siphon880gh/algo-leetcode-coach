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
            'message' => "Read the problem statement above.\nWhat is the state?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The digit the knight is on', 'next' => 's2'],
                ['label' => 'The whole number dialed so far', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Future moves depend only on the current digit.\nStep back to when you kept the whole number.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which digit has no moves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'wrong_b'],
                ['label' => '5', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 0 can jump to 4 and 6.\nStep back to when you blocked 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "n = 1. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '10: every digit, including 5', 'next' => 'success'],
                ['label' => '9', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A one-digit number needs no move, so 5 counts.\nStep back to when you dropped 5.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). n = 1 → 10. n = 2 → 20. n = 3131 → 136006598.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
