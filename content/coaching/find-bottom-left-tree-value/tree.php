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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Level-order: the answer is in the last level', 'next' => 's2'],
                ['label' => 'Follow left children from the root', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The leftmost node by following left links is 4 in example 2, but 7 is deeper.\nStep back to when you followed left links only.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "BFS, children left before right.\nWhat do you record?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The last node popped in each level', 'next' => 'wrong_b'],
                ['label' => 'q[0].val at the start of each level', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The last node of each level is the rightmost.\nStep back to when you recorded the last node.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When the queue empties, the recorded value is from the deepest level. Trick: push right before left; then the last popped node is the answer.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Record first per level; in DFS update on strictly deeper only', 'next' => 'success'],
                ['label' => 'In DFS, update when depth >= max depth', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. With DFS left first, updating on equal depth replaces the leftmost with a node to its right.\nStep back to when you updated on >=.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Last level, first node. Example 2 → 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
