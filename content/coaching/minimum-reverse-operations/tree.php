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
            'message' => "Read the problem statement above.\nLowest target L?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(i − k + 1, k − i − 1)', 'next' => 's2'],
                ['label' => 'i − k + 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Windows cannot start before index 0; n = 4, p = 3, banned = [], k = 4 → [1,2,3,0] instead of [1,−1,−1,0].\nStep back to when you dropped the wall.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Targets inside [L, R]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every position', 'next' => 'wrong_b'],
                ['label' => 'Every second position, parity of L', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A reversal moves i to 2s + k − 1 − i; n = 4, p = 1, banned = [3], k = 3 → [2,0,1,−1] instead of [−1,0,−1,−1].\nStep back to when you took every position.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → [0,−1,−1,1], [0,−1,−1,−1,−1], [−1,−1,0,−1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
