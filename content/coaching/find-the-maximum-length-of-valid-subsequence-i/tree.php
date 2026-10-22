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
            'message' => "Read the problem statement above.\nValid patterns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All even, all odd, or alternating', 'next' => 's2'],
                ['label' => 'Same parity only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 4 instead of 6.\nStep back to when you dropped alternating.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Alternating length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2 · min(evens, odds)', 'next' => 'wrong_b'],
                ['label' => 'Greedily take each parity change', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Order matters: [1, 1, 2, 2] → 4 instead of 2.\nStep back to when you used the counts.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 4, 6, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
