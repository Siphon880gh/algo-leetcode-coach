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
            'message' => "Problem: Given n courses and prerequisite relations [prev, next], you can take any number of courses per semester as long as their prerequisites were done earlier. Return the minimum number of semesters, or −1 if a cycle makes it impossible. (Restated from memory; limits and examples may differ slightly.)\nOne course per semester?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: all available courses together', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Any number of courses fit in one semester.\nStep back to when you took one at a time.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What is the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The number of courses', 'next' => 'wrong_b'],
                ['label' => 'The number of BFS levels', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Courses in one level share a semester.\nStep back to when you counted courses.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Queue empties with courses left. Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '−1', 'next' => 'success'],
                ['label' => 'The level count', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The remaining courses are in a cycle.\nStep back to when you returned the levels.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + relations). n = 3, [[1,3],[2,3]] → 2. n = 3, [[1,2],[2,3],[3,1]] → −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
