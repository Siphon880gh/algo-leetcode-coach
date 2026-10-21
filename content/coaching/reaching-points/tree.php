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
            'message' => "Read the problem statement above.\nSearch forward from (sx, sy)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: go backward, where the parent is unique', 'next' => 's2'],
                ['label' => 'Yes, with BFS', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The forward tree doubles at every level.\nStep back to when you searched forward.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "tx > ty. What is the parent?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(tx, ty − tx)', 'next' => 'wrong_b'],
                ['label' => '(tx − ty, ty), repeated fast as tx % ty', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The larger coordinate was the sum.\nStep back to when you shrank the smaller one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "ty == sy already. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return (tx − sx) % ty == 0', 'next' => 'success'],
                ['label' => 'Keep applying tx %= ty', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Modulo can overshoot below sx; check divisibility instead.\nStep back to when you kept reducing.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log max). (1,1) → (3,5): true. (1,1) → (2,2): false. (1,1) → (1,1): true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
