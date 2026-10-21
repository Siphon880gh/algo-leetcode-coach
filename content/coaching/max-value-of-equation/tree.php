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
            'message' => "Read the problem statement above.\nQuery before or after pushing j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Before', 'next' => 's2'],
                ['label' => 'After', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. i must differ from j.\nStep back to when you pushed first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pop from the back when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Back x < new x', 'next' => 'wrong_b'],
                ['label' => 'Back y − x ≤ new y − x', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The key is y − x, and x always increases.\nStep back to when you compared x.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Expired points?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Front with xj − xi > k', 'next' => 'success'],
                ['label' => 'Back with large x', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Oldest points expire first.\nStep back to when you popped the back.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Example 1 → 4. Example 2 → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
