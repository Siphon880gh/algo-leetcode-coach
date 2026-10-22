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
            'message' => "Read the problem statement above.\nOrder counts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Decreasing', 'next' => 's2'],
                ['label' => 'Increasing', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 3 → 28 instead of 24.\nStep back to when you sorted upward.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Presses for the i-th count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i + 1', 'next' => 'wrong_b'],
                ['label' => 'i / 8 + 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Eight letters share each layer; example 1 → 15 instead of 5.\nStep back to when you gave each letter its own layer.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 5, 12, 24.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
