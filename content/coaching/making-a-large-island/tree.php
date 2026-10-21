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
            'message' => "Read the problem statement above.\nFlip each 0 and re-run a full flood fill?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: label islands once and reuse their sizes', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n⁴).\nStep back to when you re-filled per cell.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A 0 touches the same island on two sides. Count it how many times?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Twice', 'next' => 'wrong_b'],
                ['label' => 'Once: use the distinct ids', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The same island would be double counted.\nStep back to when you counted per side.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The grid has no 0. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n², the whole grid', 'next' => 'success'],
                ['label' => '0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Everything is already one island.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). [[1,0],[0,1]] → 3. [[1,1],[1,0]] → 4. [[1,1],[1,1]] → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
