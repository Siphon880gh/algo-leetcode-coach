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
            'message' => "Read the problem statement above.\nIs sorting allowed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: only min and max matter', 'next' => 's2'],
                ['label' => 'No: order matters', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A subsequence is a set of indices; its min and max are order-free.\nStep back to when you refused to sort.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count for a fixed l?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'r − l + 1', 'next' => 'wrong_b'],
                ['label' => '2^(r − l)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Any subset of (l, r] can join.\nStep back to when you counted linearly.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Powers of two?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Precomputed mod table', 'next' => 'success'],
                ['label' => 'Floating pow', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Exponents reach 10^5.\nStep back to when you used floats.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 4, 6, 61.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
