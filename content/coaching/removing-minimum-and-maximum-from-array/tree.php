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
            'message' => "Read the problem statement above.\nWhich plans to compare?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both from the front, both from the back, one from each end', 'next' => 's2'],
                ['label' => 'Only both from the front or both from the back', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Example 1 → 5 takes one from each end; same-side plans need 6 or 7.\nStep back to when you dropped the mixed plan.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Positions i and j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i = min position, j = max position as found', 'next' => 'wrong_b'],
                ['label' => 'Sorted so that i ≤ j', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In Example 1 the max is left of the min; unsorted formulas give 2, which removes only the maximum.\nStep back to when you skipped sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Array of one element?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 deletion', 'next' => 'success'],
                ['label' => '2 deletions, min and max separately', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The single element is both; Example 3 → 1.\nStep back to when you counted it twice.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 5, 3, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
