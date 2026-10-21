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
            'message' => "Read the problem statement above.\nEnumerate every path?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: count the ways per cell, one move at a time', 'next' => 's2'],
                ['label' => 'Yes: DFS over every path with no memo', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. There are up to 4^50 paths.\nStep back to when you enumerated paths.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A cell has f ways and a step goes off the grid. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep them, since the ball can walk back in', 'next' => 'wrong_b'],
                ['label' => 'Add f to the answer and end those paths', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Once the ball leaves it is gone; each path is counted once, when it exits.\nStep back to when you let it come back.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Anything else before you code it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Take every sum modulo 1e9 + 7', 'next' => 'success'],
                ['label' => 'Store the big counts as floats', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Floats lose precision; the problem asks for the count modulo 1e9 + 7.\nStep back to when you used floats.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. DP over moves with exits added to the answer: O(maxMove · m · n) time, O(m · n) space.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
