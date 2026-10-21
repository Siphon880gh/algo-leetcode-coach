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
            'message' => "Read the problem statement above.\nBuild all pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, up to 10^10 pairs', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is far too many.\nStep back to when you built pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Identity used?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'XOR distributes over AND', 'next' => 'wrong_b'],
                ['label' => '(a & x) ^ (a & y) = a & (x ^ y)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It is AND that distributes over XOR.\nStep back to when you reversed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Final formula?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'xor(arr1) & xor(arr2)', 'next' => 'success'],
                ['label' => 'xor(arr1) ^ xor(arr2)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The outer operation stays AND.\nStep back to when you XORed the totals.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). Examples → 0, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
