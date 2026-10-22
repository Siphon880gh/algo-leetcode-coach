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
            'message' => "Read the problem statement above.\nChoose?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smallest index', 'next' => 's2'],
                ['label' => 'Smallest value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [1, 1, −1, 1, 1].\nStep back to when you chose by value.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Repeated value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Let the later index overwrite', 'next' => 'wrong_b'],
                ['label' => 'Skip it; the first index stays', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → [−1, 2, 0, −1] instead of [−1, 1, 0, −1].\nStep back to when you overwrote.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(M log M + n). Examples → [0, 0, −1, 1, 0], [−1, 1, 0, −1], [0, 1, 0, 1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
