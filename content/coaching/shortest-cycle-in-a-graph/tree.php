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
            'message' => "Read the problem statement above.\nA visited neighbour that is the parent?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore it', 'next' => 's2'],
                ['label' => 'Count it as a cycle', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Going back along the same edge is not a cycle; Example 2 → 2 instead of −1.\nStep back to when you counted the parent.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Run BFS from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Vertex 0 only', 'next' => 'wrong_b'],
                ['label' => 'Every vertex', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A cycle away from the start is measured too long; n = 4, edges = [[0,1],[1,2],[1,3],[2,3]] → 5 instead of 3.\nStep back to when you used one start.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · (n + m)). Examples → 3, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
