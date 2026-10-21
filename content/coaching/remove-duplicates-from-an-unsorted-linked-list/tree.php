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
            'message' => "Problem: Given the head of a linked list, delete every node whose value appears more than once in the list (all copies), and return the head. For instance, [1,2,3,2] → [1,3], [2,1,1,2] → [], and [3,2,2,1,3,2,4] → [1,4]. (Restated from memory; limits and examples may differ slightly.)\nKeep the first copy?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, remove every copy', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Values appearing more than once disappear entirely.\nStep back to when you kept the first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Head deletion?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Special-case the head in a loop', 'next' => 'wrong_b'],
                ['label' => 'Use a dummy node', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The dummy handles a deleted head uniformly.\nStep back to when you special-cased it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After unlinking a node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep prev where it is', 'next' => 'success'],
                ['label' => 'Advance prev too', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The next node still has to be checked against prev.\nStep back to when you advanced prev.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed check → [1,3], [], [1,4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
