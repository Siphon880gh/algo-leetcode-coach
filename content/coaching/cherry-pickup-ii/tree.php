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
            'message' => "Read the problem statement above.\nSolve each robot separately?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: joint state', 'next' => 's2'],
                ['label' => 'Yes, then add', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Shared cells would be double counted.\nStep back to when you separated them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Both on the same cell?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count it twice', 'next' => 'wrong_b'],
                ['label' => 'Count it once', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only one robot picks the cherries.\nStep back to when you counted twice.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Moves per robot?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Columns −1, 0, +1 within bounds', 'next' => 'success'],
                ['label' => 'Any column', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Robots move diagonally or straight down.\nStep back to when you allowed jumps.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(R · C² · 9). Example 1 → 24. Example 2 → 28.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
