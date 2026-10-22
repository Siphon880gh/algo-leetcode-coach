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
            'message' => "Read the problem statement above.\nAfter popping x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Push ceil(x / 3) back', 'next' => 's2'],
                ['label' => 'Discard it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The element stays in the array; Example 2 → 16 instead of 17.\nStep back to when you discarded it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compute ceil(x / 3) as?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x / 3 in integer division', 'next' => 'wrong_b'],
                ['label' => '(x + 2) / 3', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That rounds down; Example 2 → 16 instead of 17.\nStep back to when you floored.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + k) log n). Examples → 50, 17.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
