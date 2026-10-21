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
            'message' => "Read the problem statement above.\nCheck every pair?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: count remainders mod 60', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²) for n up to 6·10⁴.\nStep back to when you checked pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Song t. Which remainder completes it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '60 − t % 60', 'next' => 'wrong_b'],
                ['label' => '(60 − t % 60) % 60', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Remainder 0 would look for 60, which never occurs.\nStep back to when you dropped the outer % 60.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Add the pairs before or after recording t?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Before', 'next' => 'success'],
                ['label' => 'After', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A song would pair with itself.\nStep back to when you recorded first.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [30,20,150,100,40] → 3. [60,60,60] → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
