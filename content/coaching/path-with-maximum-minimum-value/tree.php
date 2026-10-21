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
            'message' => "Problem: Given a grid of non-negative integers, a path goes from the top-left to the bottom-right cell with 4-directional moves, and its score is the smallest value on it. Return the largest possible score. For instance, [[5,4,5],[1,2,6],[7,4,6]] gives 4. (Restated from memory; limits and examples may differ slightly.)\nPlain BFS?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: always expand the highest-value frontier cell', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. BFS ignores the values.\nStep back to when you used BFS.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What is the answer when the target pops?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The target\'s value', 'next' => 'wrong_b'],
                ['label' => 'The smallest value popped so far', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The score is the path minimum.\nStep back to when you returned the target's value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Another approach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort cells descending and union until start and end connect', 'next' => 'success'],
                ['label' => 'Sum the values along the path', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The score is a minimum, not a sum.\nStep back to when you summed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n · log(m · n)). [[5,4,5],[1,2,6],[7,4,6]] → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
