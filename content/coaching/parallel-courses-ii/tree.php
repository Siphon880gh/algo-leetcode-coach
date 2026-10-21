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
            'message' => "Read the problem statement above.\nGreedy by depth or out-degree?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: exact DP over masks', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Greedy layer choices have counterexamples.\nStep back to when you chose greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Available ≤ k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Still try subsets', 'next' => 'wrong_b'],
                ['label' => 'Take them all', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Taking more never hurts here.\nStep back to when you enumerated.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Subset size when more than k are available?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exactly k', 'next' => 'success'],
                ['label' => 'Any size ≤ k', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Taking fewer than k is never better.\nStep back to when you allowed smaller sets.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(3^n) worst case. Example 1 → 3. Example 2 → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
