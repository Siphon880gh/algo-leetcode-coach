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
            'message' => "Read the problem statement above.\nWhich carpet starts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The left end of each tile', 'next' => 's2'],
                ['label' => 'Every integer position', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Tiles reach 10^9, so that is far too many starts.\nStep back to when you tried every position.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The tile the carpet ends inside?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count only full tiles', 'next' => 'wrong_b'],
                ['label' => 'Add its covered part', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. tiles [[1,5]], carpetLen 3 → 0 instead of 3.\nStep back to when you dropped the partial tile.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Tile order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort by left end', 'next' => 'success'],
                ['label' => 'Input order', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The pointers assume sorted, non-overlapping tiles; Example 2 → 3 instead of 2.\nStep back to when you skipped sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 9, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
