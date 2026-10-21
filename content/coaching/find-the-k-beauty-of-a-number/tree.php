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
            'message' => "Read the problem statement above.\nA window equal to 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip it', 'next' => 's2'],
                ['label' => 'Divide anyway', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 has the window 00, and num mod 0 is a division by zero.\nStep back to when you divided by 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A window with a leading zero, like 04?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip it', 'next' => 'wrong_b'],
                ['label' => 'Its value is 4; test it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. num = 204, k = 2 → 0 instead of 1, since 4 divides 204.\nStep back to when you skipped leading zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which remainder?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'num mod window', 'next' => 'success'],
                ['label' => 'window mod num', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 → 0 instead of 2.\nStep back to when you swapped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(len · k). Examples → 2, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
