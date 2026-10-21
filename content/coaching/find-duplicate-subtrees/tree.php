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
            'message' => "Read the problem statement above.\nHow do you tell that two subtrees are identical?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Give each one a key built in postorder from its value and its children\'s keys', 'next' => 's2'],
                ['label' => 'Compare every pair of subtrees', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Pairwise comparison is O(n²) pairs times O(n) each.\nStep back to when you compared pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you key a node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its value plus the sum of its subtree', 'next' => 'wrong_b'],
                ['label' => 'A tuple (left id, value, right id), with null children marked', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Different shapes can have the same sum; the key must encode the structure, including nulls.\nStep back to when you used sums.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When do you add a root to the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When its key\'s count becomes exactly 2', 'next' => 'success'],
                ['label' => 'Every time the key repeats', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That reports the same shape several times; each duplicate is listed once.\nStep back to when you reported every repeat.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Map each (left id, value, right id) to an id and count it: O(n). [1,2,3,4,null,2,4,null,null,4] → [[2,4],[4]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
