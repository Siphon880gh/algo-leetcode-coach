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
            'message' => "Read the problem statement above.\nA fruit is already free?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'You may still buy it', 'next' => 's2'],
                ['label' => 'Never buy it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 5 instead of 4.\nStep back to when you skipped free fruits.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Next bought fruit after i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exactly 2i + 1', 'next' => 'wrong_b'],
                ['label' => 'Any j in i + 1 … 2i + 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Buying earlier can be cheaper; examples 1 and 3 → 5 and 77 instead of 4 and 39.\nStep back to when you jumped to 2i + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 4, 2, 39.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
