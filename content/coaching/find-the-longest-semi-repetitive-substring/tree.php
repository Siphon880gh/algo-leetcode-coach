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
            'message' => "Read the problem statement above.\nHow many adjacent equal pairs may the window hold?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At most one', 'next' => 's2'],
                ['label' => 'None', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. One pair is allowed; example 1 → 2 instead of 4.\nStep back to when you allowed none.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A second pair appears?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Move l to one before that', 'next' => 'wrong_b'],
                ['label' => 'Move l to the earlier pair’s second index', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Both pairs stay inside; example 3 → 3 instead of 2.\nStep back to when you moved l too little.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 4, 4, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
