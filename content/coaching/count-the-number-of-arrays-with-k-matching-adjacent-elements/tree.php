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
            'message' => "Read the problem statement above.\nFirst element?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'm choices', 'next' => 's2'],
                ['label' => '1 choice', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 2 instead of 4.\nStep back to when you fixed it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Each unequal step?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'm choices', 'next' => 'wrong_b'],
                ['label' => 'm − 1 choices', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 8 instead of 4.\nStep back to when you allowed m.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + log n). Examples → 4, 6, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
