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
            'message' => "Read the problem statement above.\nStart at a 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[i] = 0', 'next' => 's2'],
                ['label' => 'Allow it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. No leading zeros.\nStep back to when you allowed it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Stop extending when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'After a fixed 5 digits', 'next' => 'wrong_b'],
                ['label' => 'Value exceeds k', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The bound is k, which can have up to 10 digits.\nStep back to when you fixed a length.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Modulo?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1e9+7 each dp', 'next' => 'success'],
                ['label' => 'None', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The count is huge.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · digits(k)). \"1000\", 10000 → 1. \"1000\", 10 → 0. \"1317\", 2000 → 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
