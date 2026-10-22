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
            'message' => "Read the problem statement above.\nCollisions?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore them: robots pass through', 'next' => 's2'],
                ['label' => 'Simulate every step and swap directions', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. d can be 10^9 steps for 10^5 robots, far too slow.\nStep back to when you simulated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Store final positions in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '32-bit integers', 'next' => 'wrong_b'],
                ['label' => '64-bit integers', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A position can reach 2 · 10^9 + 10^9 = 3 · 10^9, past 2^31 − 1.\nStep back to when you chose 32 bits.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 8, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
