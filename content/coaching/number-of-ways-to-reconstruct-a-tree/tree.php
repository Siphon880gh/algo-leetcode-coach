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
            'message' => "Read the problem statement above.\nRoot condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Degree = number of nodes − 1', 'next' => 's2'],
                ['label' => 'Smallest value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The root is an ancestor of every node, so it pairs with all of them.\nStep back to when you picked by value.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which neighbour is the parent?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Largest degree neighbour', 'next' => 'wrong_b'],
                ['label' => 'Smallest degree among neighbours with degree ≥ own', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The nearest ancestor has the fewest pairs among ancestors.\nStep back to when you took the largest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When is the answer 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A node and its parent have equal degree', 'next' => 'success'],
                ['label' => 'Whenever there are ties anywhere', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only equal degree between child and parent lets them swap.\nStep back to when you used any tie.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(N · pairs) with sets. Examples → 1, 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
