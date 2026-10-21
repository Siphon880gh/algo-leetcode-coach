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
            'message' => "Read the problem statement above.\nMark lit cells on an n × n grid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: n reaches 10⁹; count lamps per line', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The grid is far too large.\nStep back to when you built the grid.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The same lamp appears twice in the input. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count it twice', 'next' => 'wrong_b'],
                ['label' => 'Count it once', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Turning it off would leave a phantom count.\nStep back to when you counted it twice.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After a query, which lamps go off?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Those in the 3 × 3 block around the query cell', 'next' => 'success'],
                ['label' => 'Only the lamp at the query cell', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The eight neighbours turn off too.\nStep back to when you turned off one lamp.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(L + Q). n = 5, lamps [[0,0],[4,4]], queries [[1,1],[1,0]] → [1,0]. Same lamps, queries [[1,1],[1,1]] → [1,1]. n = 5, lamps [[0,0],[0,4]], queries [[0,4],[0,1],[1,4]] → [1,1,0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
