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
            'message' => "Read the problem statement above.\nFirst pass?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count servers per row and column', 'next' => 's2'],
                ['label' => 'BFS components', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Communication is just sharing a row or column.\nStep back to when you ran BFS.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A server communicates when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both > 1', 'next' => 'wrong_b'],
                ['label' => 'rowCount > 1 or colCount > 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. One shared line is enough.\nStep back to when you required both.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Count what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Servers', 'next' => 'success'],
                ['label' => 'Rows and columns', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The answer counts servers.\nStep back to when you counted lines.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). [[1,0],[0,1]] → 0. [[1,0],[1,1]] → 3. Third example → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
