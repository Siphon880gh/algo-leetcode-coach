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
            'message' => "Read the problem statement above.\nCount apples by summing cells?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, use 2k(k + 1)(2k + 1)', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is cubic per k.\nStep back to when you summed cells.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Perimeter from k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '4k', 'next' => 'wrong_b'],
                ['label' => '8k', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The side length is 2k.\nStep back to when you used side k.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Values up to 10^15?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit arithmetic', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The totals overflow 32 bits.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → 8, 16, 5040.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
