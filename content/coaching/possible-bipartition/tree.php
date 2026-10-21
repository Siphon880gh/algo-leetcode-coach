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
            'message' => "Read the problem statement above.\nWhat graph question is this?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Is the dislike graph bipartite?', 'next' => 's2'],
                ['label' => 'Does the graph have a cycle?', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Even cycles are fine; only an odd cycle blocks a split.\nStep back to when you looked for any cycle.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Where do you start coloring?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'From person 1 only', 'next' => 'wrong_b'],
                ['label' => 'From every uncolored person', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The graph can have several components.\nStep back to when you started once.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A neighbor already has the same color. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return false', 'next' => 'success'],
                ['label' => 'Recolor it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Recoloring breaks constraints you already checked.\nStep back to when you recolored.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). n = 4, [[1,2],[1,3],[2,4]] → true. n = 3, [[1,2],[1,3],[2,3]] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
