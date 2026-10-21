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
            'message' => "Read the problem statement above.\nPath cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Maximum absolute difference along it', 'next' => 's2'],
                ['label' => 'Sum of differences', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Effort is the single largest step.\nStep back to when you summed.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Relaxation?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nd = d + |Δh|', 'next' => 'wrong_b'],
                ['label' => 'nd = max(d, |Δh|)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is the sum again.\nStep back to when you added.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Alternatives?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Binary search + BFS, or DSU by edge weight', 'next' => 'success'],
                ['label' => 'Plain DFS is optimal', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. DFS without a bound explores exponentially many paths.\nStep back to when you chose DFS.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(mn log(mn)). Examples → 2, 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
