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
            'message' => "Problem: There are n houses. A well in house i has a given cost and pipes between houses have costs. Return the minimum total cost to supply every house. For instance, 3 houses with well costs [1,2,2] and pipes [[1,2,1],[2,3,1]] cost 3. (Restated from memory; limits and examples may differ slightly.)\nChoose wells first, then pipes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: wells become edges to node 0', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Wells and pipes trade off against each other.\nStep back to when you chose wells first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Edge endpoints already joined?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add it', 'next' => 'wrong_b'],
                ['label' => 'Skip the edge', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It would only add cost.\nStep back to when you added it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When to stop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'After n unions', 'next' => 'success'],
                ['label' => 'After n − 1 unions', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. There are n + 1 nodes with the virtual one.\nStep back to when you stopped early.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + p) log (n + p)). Wells [1,2,2], pipes [[1,2,1],[2,3,1]] → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
