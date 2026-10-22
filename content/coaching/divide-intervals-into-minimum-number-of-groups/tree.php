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
            'message' => "Read the problem statement above.\nReuse a group whose end e when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'e < left', 'next' => 's2'],
                ['label' => 'e ≤ left', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Intervals are inclusive, so [1,5] and [5,8] intersect → 1 instead of 2.\nStep back to when you allowed e = left.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sort intervals by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Right end', 'next' => 'wrong_b'],
                ['label' => 'Left end', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 4 instead of 3.\nStep back to when you sorted by right end.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Compare the new interval with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The smallest end in a min-heap', 'next' => 'success'],
                ['label' => 'The most recently opened group', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. An older group may be free; Example 1 → 4 instead of 3.\nStep back to when you checked only the newest group.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 3, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
