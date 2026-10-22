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
            'message' => "Problem: A binary matrix is given. Moving only right or down from the top-left cell to the bottom-right cell, decide whether some path visits as many 0s as 1s. For instance, [[0,1,0],[0,1,1]] → true; [[0,1],[1,0]] → false, since every path there has 3 cells. (Restated from memory; limits and examples may differ slightly.)\nm + n − 1 is odd?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return false', 'next' => 's2'],
                ['label' => 'Aim for half, rounded down', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. An odd count of cells cannot split evenly; [[0,1],[1,0]] → true instead of false.\nStep back to when you rounded.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Test the target against?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the most 1s', 'next' => 'wrong_b'],
                ['label' => 'Both the fewest and the most 1s', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every path may have too many 1s; [[1,1,1],[1,1,1]] → true instead of false.\nStep back to when you checked only the maximum.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Constructed checks → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
