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
            'message' => "Read the problem statement above.\n(8, 1) to (1, 8). How many moves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2: across, then down', 'next' => 'wrong_a'],
                ['label' => '1: they share a diagonal', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. |8 − 1| = |1 − 8|, so they share a diagonal. Forgetting diagonals gives 2 instead of 1.\nStep back to when you skipped the diagonal.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "(4, 2) to (1, 3) share no line. Could it ever need 3 moves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, a row move then a column move always works', 'next' => 'success'],
                ['label' => 'Yes, if the squares are far apart', 'next' => 'wrong_b'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Move along row 4 to (4, 3), then along column 3 to (1, 3). The board is empty, so 2 is always enough.\nStep back to when you allowed 3.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. 0, 1 or 2 by three checks. O(1). Examples give 1, 2 and 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
