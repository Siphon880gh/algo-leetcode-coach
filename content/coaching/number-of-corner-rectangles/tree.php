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
            'message' => "Problem: Problem: Given a 0/1 grid, count the axis-aligned rectangles whose four corner cells are all 1 (the inside does not matter, and the corners must be distinct). (Restated from memory; limits and examples may differ slightly.)\nEnumerate all four corners?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: fix two rows, then count column pairs', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(m² · n²).\nStep back to when you enumerated corners.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Two rows share c columns with 1s. How many rectangles?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'c', 'next' => 'wrong_b'],
                ['label' => 'c · (c − 1) / 2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Any two of the shared columns form a rectangle.\nStep back to when you counted columns.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Rows are sparse. Faster idea?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'For each row, pair its 1-columns and add a counter keyed by the pair, then increment it', 'next' => 'success'],
                ['label' => 'Transpose the grid', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Transposing alone changes nothing; the pair counter avoids looking at zeros.\nStep back to when you transposed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m² · n) or O(m · k²). [[1,0,0,1,0],[0,0,1,0,1],[0,0,0,1,0],[1,0,1,0,1]] → 1. [[1,1,1],[1,1,1],[1,1,1]] → 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
