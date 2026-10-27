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
            'message' => "Read the problem statement above.\nF(i) + F(i + 1) + F(i + 2) equals what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2 · F(i + 2)', 'next' => 's2'],
                ['label' => 'F(i + 3)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. F(i + 3) = F(i + 1) + F(i + 2), which leaves out F(i). For 3, 5, 8 the sum is 16, not 13.\nStep back to when you used F(i + 3).",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "n = 8. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'true, 8 is a Fibonacci number', 'next' => 'wrong_b'],
                ['label' => 'false, 8 / 2 = 4 is not Fibonacci', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You need 8 = 2 · F, so F = 4, which is not Fibonacci. Testing n itself gives true instead of false.\nStep back to when you tested n.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. n even and n / 2 in the Fibonacci set. Examples give true, false and true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
