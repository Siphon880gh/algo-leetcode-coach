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
            'message' => "Read the problem statement above.\nNegative values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Normalise: ((x % k) + k) % k', 'next' => 's2'],
                ['label' => 'Raw %', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Some languages return negative remainders.\nStep back to when you used raw %.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Remainder 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any count', 'next' => 'wrong_b'],
                ['label' => 'Even count', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Zeros pair with zeros.\nStep back to when you ignored parity.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "r = k/2 for even k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Even count (self-paired)', 'next' => 'success'],
                ['label' => 'Pairs with 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. k/2 + k/2 = k.\nStep back to when you paired it with 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + k). Example 1 → true. k = 7 → true. k = 10 → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
