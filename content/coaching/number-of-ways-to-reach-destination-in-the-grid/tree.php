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
            'message' => "Problem: In an n × m grid, one move goes from the current cell to any other cell in the same row or the same column. Count the ways to go from a given source cell to a given destination cell in exactly k moves, modulo the value in the official statement. Indexing and limits are in the official statement. For instance, in a 3 × 4 grid, from one corner to the opposite corner in 3 moves → 9. (Restated from memory; limits and examples may differ slightly.)\nWhat to track per move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Four counts: at the destination, row only, column only, neither', 'next' => 's2'],
                ['label' => 'A count for every cell', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Every cell has n + m − 2 moves, so each step costs about n·m·(n + m) work, while all cells in one class behave the same.\nStep back to when you tracked every cell.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "From neither, how many moves stay neither?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n + m − 2', 'next' => 'wrong_b'],
                ['label' => 'n + m − 4', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Two of those moves enter the destination’s row or column; the 3 × 4 corner example → 13 instead of 9.\nStep back to when you used n + m − 2.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k). The 3 × 4 corner example → 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
