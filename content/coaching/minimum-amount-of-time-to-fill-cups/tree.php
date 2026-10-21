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
            'message' => "Read the problem statement above.\nAnswer is at least?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both max(amount) and ceil(sum / 2)', 'next' => 's2'],
                ['label' => 'Only ceil(sum / 2)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. One type cannot fill two cups at once; Example 3 → 3 instead of 5.\nStep back to when you used only half the total.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Is max(amount) enough alone?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No, take the larger of the two', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 5 instead of 7.\nStep back to when you used only the largest pile.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Simulating: fill which two?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The two largest piles', 'next' => 'success'],
                ['label' => 'The two smallest non-empty piles', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The big pile is left to drain alone; Example 1 → 5 instead of 4.\nStep back to when you picked the smallest.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 4, 7, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
