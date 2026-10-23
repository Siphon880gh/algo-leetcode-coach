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
            'message' => "Read the problem statement above.\nAnswer for the whole array?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, recompute without word i', 'next' => 's2'],
                ['label' => 'Yes, the same for every i', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [4, 4, 4, 4, 4] instead of [3, 4, 4, 3, 4].\nStep back to when you ignored the removal.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which words lose D?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every word through a good node at D', 'next' => 'wrong_b'],
                ['label' => 'Those through the only good node at D whose count is exactly k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [ab, ab, ab], k = 2 → [1, 1, 1] instead of [2, 2, 2].\nStep back to when you ignored the count.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total length). Examples → [3, 4, 4, 3, 4], [0, 0, 0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
