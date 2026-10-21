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
            'message' => "Read the problem statement above.\nClassic LCS DP?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: 10^5 × 10^5 is too big', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. O(n · m) is far too slow.\nStep back to when you used LCS DP.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why does LIS work?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It always does', 'next' => 'wrong_b'],
                ['label' => 'Target values are distinct', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Distinctness makes each value map to one index.\nStep back to when you assumed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Strict or non-strict LIS?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Strictly increasing', 'next' => 'success'],
                ['label' => 'Non-decreasing', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One target index can match only once.\nStep back to when you allowed equality.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m log n). Examples → 2, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
