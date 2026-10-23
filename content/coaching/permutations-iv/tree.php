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
            'message' => "Read the problem statement above.\nCompletions after a choice?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'odds! · evens! when they fit', 'next' => 's2'],
                ['label' => '(numbers left)!', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [] instead of [3, 4, 1, 2].\nStep back to when you ignored parity.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "k larger than the total?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return the last permutation', 'next' => 'wrong_b'],
                ['label' => 'Return []', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → [2, 1] instead of [].\nStep back to when you clamped k.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → [3, 4, 1, 2], [3, 2, 1], [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
