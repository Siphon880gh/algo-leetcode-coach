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
            'message' => "Problem: A table holds distinct points in the plane. Return the shortest Euclidean distance between any two of them, rounded as the statement specifies. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nWhich pairs do you compare?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every pair: a self-join', 'next' => 's2'],
                ['label' => 'Only neighbors after sorting by x', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. In 2D the closest pair does not have to be adjacent in x order.\nStep back to when you sorted by x.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What is the join condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a.x != b.x AND a.y != b.y', 'next' => 'wrong_b'],
                ['label' => '(a.x, a.y) < (b.x, b.y), so each pair appears once', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That skips points that share a coordinate, like (-1,-1) and (-1,-2) in the example.\nStep back to when you required both to differ.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What distance do you compute?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'SQRT(POW(dx, 2) + POW(dy, 2))', 'next' => 'success'],
                ['label' => 'ABS(dx) + ABS(dy)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That is the Manhattan distance; the problem asks for the Euclidean one.\nStep back to when you summed absolute values.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Self-join distinct pairs, Euclidean distance, ROUND(MIN(…), 2): O(n²) pairs.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
