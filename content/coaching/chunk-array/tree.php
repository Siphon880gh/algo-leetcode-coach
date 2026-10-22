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
            'message' => "Read the problem statement above.\nWhere does each chunk start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every size elements, slicing i to i + size', 'next' => 's2'],
                ['label' => 'At every index', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Chunks would overlap; in Node [1, 2, 3] with size 2 → [[1, 2], [2, 3], [3]] instead of [[1, 2], [3]].\nStep back to when you started a chunk at every index.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "An empty array?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Push one chunk before checking the length', 'next' => 'wrong_b'],
                ['label' => 'The loop never runs, return []', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 4 needs []; in Node a do-while version → [[]].\nStep back to when you pushed before checking.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples (run in Node) → [[1],[2],[3],[4],[5]], [[1,9,6],[3,2]], [[8,5,3,2,6]], [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
