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
            'message' => "Read the problem statement above.\nStart BFS only from node 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: start from every uncolored node, since the graph can be disconnected', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. An odd cycle in another component would be missed.\nStep back to when you started only at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A neighbor already has the same color. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Recolor it', 'next' => 'wrong_b'],
                ['label' => 'Return false', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A same-color edge means an odd cycle.\nStep back to when you recolored.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What graph property is being tested?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No odd cycles', 'next' => 'success'],
                ['label' => 'No cycles at all', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Even cycles are fine, like a square.\nStep back to when you banned all cycles.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(V + E). [[1,3],[0,2],[1,3],[0,2]] → true. [[1,2,3],[0,2],[0,1,3],[0,2]] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
