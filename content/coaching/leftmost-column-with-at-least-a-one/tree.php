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
            'message' => "Problem: A binary matrix with rows sorted (0s then 1s) is readable only through an interface for its dimensions and single cells, with a limited number of calls. Return the leftmost column with a 1, or −1. For instance, rows [0,0,1] and [0,1,1] give 1. (Restated from memory; limits and examples may differ slightly.)\nStart corner?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Top-right', 'next' => 's2'],
                ['label' => 'Top-left', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. From the top-left, neither move is decisive.\nStep back to when you started there.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Read a 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Move left', 'next' => 'wrong_b'],
                ['label' => 'Move down', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Everything left of a 0 in that row is 0.\nStep back to when you moved left.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Read every cell?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: at most m + n reads', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The call budget is limited.\nStep back to when you scanned all cells.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m + n) reads. Rows [0,0,1], [0,1,1] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
