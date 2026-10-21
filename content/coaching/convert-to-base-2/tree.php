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
            'message' => "Read the problem statement above.\nDigit at each step?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n & 1, which is 0 or 1', 'next' => 's2'],
                ['label' => 'n % −2 in a language that can return −1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Digits must be 0 or 1.\nStep back to when you used the raw remainder.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Next n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n / 2', 'next' => 'wrong_b'],
                ['label' => '(n − r) / −2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The base is −2.\nStep back to when you divided by 2.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "n = 0 at the start. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '"0"', 'next' => 'success'],
                ['label' => '""', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The loop never runs, but 0 still has a digit.\nStep back to when you returned an empty string.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n). 2 → \"110\". 3 → \"111\". 4 → \"100\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
