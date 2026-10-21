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
            'message' => "Problem: A room is a 0-indexed binary grid where 0 is an empty space and 1 is an object; the top-left cell is empty. A robot starts there facing right and cleans every space it visits. It moves straight ahead until the next cell is an object or off the grid, then turns 90 degrees clockwise and continues, forever. Return the number of distinct spaces it cleans. For instance, [[0,0,0],[1,1,0],[0,0,0]] → 7 and [[0,1,0],[1,0,0],[0,0,0]] → 1. (Restated from memory; limits and examples may differ slightly.)\nBlocked ahead?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Turn 90 degrees clockwise and keep going', 'next' => 's2'],
                ['label' => 'Stop', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The robot only turns; it never stops on its own.\nStep back to when you stopped.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When does the walk end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When it reaches a cell it already cleaned', 'next' => 'wrong_b'],
                ['label' => 'When (row, col, direction) repeats', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In [[0,0,1],[1,0,0],[0,0,0]] it passes a cleaned cell and still reaches a new one: 6 cells, not 5.\nStep back to when you stopped at a cleaned cell.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What do you return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Number of distinct cells', 'next' => 'success'],
                ['label' => 'Number of moves', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Cells cleaned twice count once.\nStep back to when you counted moves.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. At most 4 · m · n states. Constructed checks → 7, 1, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
