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
            'message' => "Read the problem statement above.\nRun a BFS from every node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: solve one root, then reroot', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²) for n up to 3·10⁴.\nStep back to when you ran n searches.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What does the first pass from root 0 compute?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the depths', 'next' => 'wrong_b'],
                ['label' => 'Subtree sizes and the sum of depths', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Rerooting needs the subtree sizes.\nStep back to when you skipped the sizes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Move the root from p to its child c. ans[c] = ?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ans[p] − count[c] + (n − count[c])', 'next' => 'success'],
                ['label' => 'ans[p] + count[c]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Nodes in c's subtree get 1 closer and the other n − count[c] nodes get 1 farther.\nStep back to when you moved the root.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). n = 6, edges [[0,1],[0,2],[2,3],[2,4],[2,5]] → [8,12,6,10,10,10].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
