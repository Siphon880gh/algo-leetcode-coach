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
            'message' => "Problem: You get the height m and width n of a board and a starting cell for a knight. Find an order in which the knight, using only knight moves, visits every cell exactly once, starting from the given cell. Return the board with each cell holding the step at which it is visited, 0 for the start. The limits are in the official statement, and the inputs guarantee that a tour exists. For instance, a 1 × 1 board → [[0]]. (Restated from memory; limits and examples may differ slightly.)\nA branch fails?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reset the cell to −1, try the next move', 'next' => 's2'],
                ['label' => 'Leave the number in place', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Stale cells look visited; a 4 × 5 board from a corner → no tour found, though one exists (checked in code).\nStep back to when you skipped the reset.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Stop when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The knight has no move left', 'next' => 'wrong_b'],
                ['label' => 'Step m · n − 1 is written', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A dead end is not a tour; a 4 × 5 board from a corner, taking the first move each time → stops with cells unvisited.\nStep back to when you stopped at the dead end.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Exponential worst case. Constructed checks → [[0]], a 3 × 4 tour.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
