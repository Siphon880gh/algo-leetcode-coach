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
            'message' => "Read the problem statement above.\nPick y?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First larger value with a different count', 'next' => 's2'],
                ['label' => 'The next larger value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [1, 2] instead of [1, 3].\nStep back to when you skipped the count check.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Different means?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Larger', 'next' => 'wrong_b'],
                ['label' => 'Not equal', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [−1, −1] instead of [1, 3].\nStep back to when you required a larger count.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + V²). Examples → [1, 3], [−1, −1], [−1, −1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
