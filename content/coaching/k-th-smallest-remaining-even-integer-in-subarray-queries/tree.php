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
            'message' => "Read the problem statement above.\nAnswer 2k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, removed evens shift it', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [2, 4, 6] instead of [2, 6, 6].\nStep back to when you ignored removals.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which removed evens count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All evens in the subarray', 'next' => 'wrong_b'],
                ['label' => 'Only those ≤ the candidate', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [4, 6, 6] instead of [2, 6, 6].\nStep back to when you counted every even.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(q log² n). Examples → [2, 6, 6], [6, 2, 12], [2, 8].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
