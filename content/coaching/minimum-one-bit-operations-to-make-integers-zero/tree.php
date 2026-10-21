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
            'message' => "Read the problem statement above.\nBFS over states?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: n reaches 10^9', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The state space is far too large.\nStep back to when you started BFS.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cost to clear a lone bit k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k + 1', 'next' => 'wrong_b'],
                ['label' => '2^(k+1) − 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each higher bit doubles the work plus one.\nStep back to when you counted linearly.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Closed form?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prefix XOR of n\'s shifts', 'next' => 'success'],
                ['label' => 'Popcount of n', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. n = 4 needs 7, not 1.\nStep back to when you used popcount.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n). n = 3 → 2. n = 6 → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
