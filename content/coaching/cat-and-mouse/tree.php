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
            'message' => "Read the problem statement above.\nPlain DFS with memo?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the game has cycles; propagate backward from known results', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Cycles leave states unresolved or mislabeled.\nStep back to when you used DFS.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A parent's mover can reach a state they win. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Decrement the parent\'s degree', 'next' => 'wrong_b'],
                ['label' => 'The parent is a win for that mover', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. One winning move is enough.\nStep back to when you only counted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Can the cat move to node 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the hole is forbidden for the cat', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The cat may not enter the hole, which also lowers its degree counts.\nStep back to when you allowed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n³). [[2,5],[3],[0,4,5],[1,4,5],[2,3],[0,2,3]] → 0. [[1,3],[0],[3],[0,2]] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
