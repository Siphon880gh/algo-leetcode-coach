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
            'message' => "Read the problem statement above.\nAnswer per step?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Heap top after popping stale entries', 'next' => 's2'],
                ['label' => 'A running maximum', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Removals lower the maximum: example 1 → [3, 3, 3, 3].\nStep back to when you kept a running maximum.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count type?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '32-bit', 'next' => 'wrong_b'],
                ['label' => '64-bit', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. One ID can reach 10^5 · 10^5 = 10^10 copies.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → [3, 3, 2, 2], [2, 0, 1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
