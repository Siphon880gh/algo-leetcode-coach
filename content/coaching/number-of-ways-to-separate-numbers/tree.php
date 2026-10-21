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
            'message' => "Read the problem statement above.\nState?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Start and length of the last number', 'next' => 's2'],
                ['label' => 'Only the end position', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The next number must be ≥ the last one, so its length is needed.\nStep back to when you dropped the length.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Previous number shorter than the current one?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Must be compared digit by digit', 'next' => 'wrong_b'],
                ['label' => 'Always allowed', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. No leading zeros, so a shorter number is always smaller.\nStep back to when you compared.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Equal-length comparison?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(1) using a longest-common-prefix table', 'next' => 's4'],
                ['label' => 'Compare strings each time', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That makes the DP O(n³), too slow for n = 3500.\nStep back to when you compared directly.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        's4' => [
            'message' => "A number starting with 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Allowed if it is a single digit 0', 'next' => 'wrong_d'],
                ['label' => 'Contributes 0 ways', 'next' => 'success'],
            ],
        ],
        'wrong_d' => [
            'message' => "You are wrong. Every number must be positive; “094” → 0.\nStep back to when you allowed 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's4',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 2, 0, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
