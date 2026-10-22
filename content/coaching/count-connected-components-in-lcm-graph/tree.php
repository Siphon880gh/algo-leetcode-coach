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
            'message' => "Read the problem statement above.\nJoin when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both divide some m ≤ threshold', 'next' => 's2'],
                ['label' => 'One divides the other', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 3 instead of 2 (lcm(2, 3) = 6).\nStep back to when you checked divisibility.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Values above threshold?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip them', 'next' => 'wrong_b'],
                ['label' => 'Each is its own component', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 2 instead of 4.\nStep back to when you skipped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(T log T + n). Examples → 4, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
