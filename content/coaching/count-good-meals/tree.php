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
            'message' => "Read the problem statement above.\nHow many powers to try?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '22 (sums up to 2^21)', 'next' => 's2'],
                ['label' => '32', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Values are at most 2^20, so sums never exceed 2^21.\nStep back to when you tried 32.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count earlier or all elements?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All, then halve', 'next' => 'wrong_b'],
                ['label' => 'Earlier only', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Halving breaks self-pairs like 1 + 1 at the same index.\nStep back to when you counted all.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Modulo?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Apply 1e9+7', 'next' => 'success'],
                ['label' => 'Not needed', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Pair counts can reach about 5 · 10^9.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(22 · n). Examples → 4, 15.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
