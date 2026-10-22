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
            'message' => "Read the problem statement above.\nFirst?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Check a + b > c', 'next' => 's2'],
                ['label' => 'Count equal sides', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [2, 2, 5] → isosceles instead of none.\nStep back to when you counted first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Not a triangle when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a + b < c', 'next' => 'wrong_b'],
                ['label' => 'a + b ≤ c', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A flat triangle is none; [1, 2, 3] → scalene.\nStep back to when you used <.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → equilateral, scalene.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
