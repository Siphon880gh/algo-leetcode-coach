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
            'message' => "Read the problem statement above.\nPlain BFS?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: weights differ', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Fewer edges is not higher probability.\nStep back to when you used BFS.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Combine along a path?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add', 'next' => 'wrong_b'],
                ['label' => 'Multiply', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Independent successes multiply.\nStep back to when you added.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Why is Dijkstra valid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Multiplying by ≤ 1 never increases', 'next' => 'success'],
                ['label' => 'It always is', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. It relies on monotone path values.\nStep back to when you assumed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((V + E) log V). Examples → 0.25, 0.3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
