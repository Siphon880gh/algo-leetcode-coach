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
            'message' => "Read the problem statement above.\nValid when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Largest < sum of the others', 'next' => 's2'],
                ['label' => 'Largest ≤ sum of the others', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [1, 1, 2] is flat; you return 4 instead of −1.\nStep back to when you allowed equality.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When it fails, drop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The smallest side', 'next' => 'wrong_b'],
                ['label' => 'The largest side', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Dropping small sides only makes it worse; example 2 → −1 instead of 12.\nStep back to when you dropped the smallest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 15, 12, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
