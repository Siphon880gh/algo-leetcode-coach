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
            'message' => "Read the problem statement above.\nInitial permits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'foo 1, bar 0', 'next' => 's2'],
                ['label' => 'Both 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. bar could print first.\nStep back to when you opened both.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After printing foo, release which semaphore?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'foo\'s', 'next' => 'wrong_b'],
                ['label' => 'bar\'s', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. foo would print twice in a row.\nStep back to when you released foo's.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Use one shared mutex instead?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: it does not encode whose turn it is', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Either thread could grab it next.\nStep back to when you used a mutex.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). n = 1 → \"foobar\". n = 2 → \"foobarfoobar\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
