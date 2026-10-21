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
            'message' => "Read the problem statement above.\nCheck each recipe how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Kahn\'s algorithm: missing-ingredient counts reaching 0', 'next' => 's2'],
                ['label' => 'One pass in input order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. With recipes [sandwich, bread] where sandwich needs bread, one pass misses sandwich.\nStep back to when you made one pass.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Recipes that depend on each other in a cycle?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Make them anyway', 'next' => 'wrong_b'],
                ['label' => 'They never reach 0 and are not made', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Neither can be made first.\nStep back to when you made them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Where does the queue start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'With every supply', 'next' => 'success'],
                ['label' => 'With the first recipe', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Supplies are what you already have; recipes become available from them.\nStep back to when you started from a recipe.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total ingredients). Examples → [bread], [bread,sandwich], [bread,sandwich,burger].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
