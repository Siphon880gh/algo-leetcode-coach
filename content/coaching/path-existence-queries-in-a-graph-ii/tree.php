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
            'message' => "Read the problem statement above.\nAnswer for a connected pair?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count the jumps', 'next' => 's2'],
                ['label' => 'Always 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → [1, 1, −1, 1] instead of [1, 2, −1, 1].\nStep back to when you answered 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "One step from sorted position i reaches?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only i + 1', 'next' => 'wrong_b'],
                ['label' => 'Up to far[i]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [3, 1] instead of [1, 1].\nStep back to when you moved one position at a time.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) log n). Examples → [1, 1], [1, 2, −1, 1], [0, −1, −1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
