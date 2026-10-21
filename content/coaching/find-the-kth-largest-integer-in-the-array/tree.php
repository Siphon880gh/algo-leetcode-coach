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
            'message' => "Read the problem statement above.\nHow to compare two numeric strings?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Length first, then lexicographic', 'next' => 's2'],
                ['label' => 'Plain string comparison', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 10 sorts before 3 as strings.\nStep back to when you compared strings directly.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Parse into 64-bit integers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No, strings can have 100 digits', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 100 digits overflow any fixed-width integer.\nStep back to when you parsed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Duplicates?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count each copy', 'next' => 'success'],
                ['label' => 'Remove them first', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. [0, 0] with k = 2 → 0 needs both copies.\nStep back to when you deduplicated.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n · L). Examples → 3, 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
