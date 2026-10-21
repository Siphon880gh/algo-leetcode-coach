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
            'message' => "Problem: An m × n 0/1 matrix with up to 1e4 cells. Return the longest line of consecutive 1s, horizontal, vertical, diagonal or anti-diagonal. [[0,1,1,0],[0,1,1,0],[0,0,0,1]] → 3. (Restated from memory; limits and examples may differ slightly.)\nIs one count per cell enough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: four counts, one per direction', 'next' => 's2'],
                ['label' => 'Yes: the longest run through the cell', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Runs in different directions cannot be chained; one number would join a horizontal run to a vertical one.\nStep back to when you kept one count.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A 1 at (i, j). Where do the four counts come from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The right and down neighbors', 'next' => 'wrong_b'],
                ['label' => 'Left (i, j − 1), up (i − 1, j), diagonal (i − 1, j − 1), anti-diagonal (i − 1, j + 1), each + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Scanning top to bottom and left to right, only cells above and to the left are finished. The anti-diagonal uses up-right, which is in the previous row.\nStep back to when you used unfinished cells.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The cell is 0. What happens to the counts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All four reset to 0', 'next' => 'success'],
                ['label' => 'Copy the counts from the neighbors', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A 0 breaks every line through it.\nStep back to when you carried counts across a 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Four DP counts per cell and a running max: O(m · n) time, O(n) with rolling rows.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
