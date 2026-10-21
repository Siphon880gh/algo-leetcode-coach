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
            'message' => "Read the problem statement above.\nRow patterns for n = 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '12: 6 ABA + 6 ABC', 'next' => 's2'],
                ['label' => '27', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Adjacent cells in a row must differ.\nStep back to when you counted 3^3.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Next ABA count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2·aba + 2·abc', 'next' => 'wrong_b'],
                ['label' => '3·aba + 2·abc', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is the ABC transition.\nStep back to when you used it for ABA.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Modulo?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every step', 'next' => 'success'],
                ['label' => 'Only at the end', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Counts grow exponentially.\nStep back to when you delayed the modulo.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). n = 1 → 12; n = 2 → 54; n = 5000 → 30228214.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
