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
            'message' => "Read the problem statement above.\nWhat can the extra directed edge cause?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A node with two parents, a cycle, or both', 'next' => 's2'],
                ['label' => 'Only a cycle, as in problem 684', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A directed extra edge can give a node two parents without any directed cycle.\nStep back to when you only looked for cycles.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A node has two parents: cand1 (earlier) and cand2 (later). What next?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return cand2', 'next' => 'wrong_b'],
                ['label' => 'Union every edge except cand2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. If cand1 is on a cycle, removing cand2 still leaves the cycle.\nStep back to when you returned cand2.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Without cand2, a cycle still appears. Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'cand1 if candidates exist, otherwise the edge that closed the cycle', 'next' => 'success'],
                ['label' => 'cand2', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Removing cand2 did not fix the cycle, so cand2 is innocent.\nStep back to when you returned cand2.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Candidates plus union-find: O(n α(n)). [[1,2],[1,3],[2,3]] → [2,3]. [[2,1],[3,1],[4,2],[1,4]] → [2,1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
