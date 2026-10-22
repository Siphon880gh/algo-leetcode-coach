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
            'message' => "Read the problem statement above.\nOne drop found; also check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[n − 1] < nums[0]', 'next' => 's2'],
                ['label' => 'Nothing', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The tail must fit before the head; example 3 → 2 instead of −1.\nStep back to when you skipped the wrap.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Shifts needed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i + 1', 'next' => 'wrong_b'],
                ['label' => 'n − i − 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That counts the front part; example 1 → 3 instead of 2.\nStep back to when you used i + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 0, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
