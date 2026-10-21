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
            'message' => "Read the problem statement above.\nRescan the string after each removal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: a stack handles chains', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That can be O(n² / k).\nStep back to when you rescanned.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Stack items?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Characters only', 'next' => 'wrong_b'],
                ['label' => '[character, run count]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Counts detect a run of k in O(1).\nStep back to when you stored characters.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A run is popped. What can happen next?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The runs on both sides may merge', 'next' => 'success'],
                ['label' => 'Nothing', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Equal neighbours become adjacent.\nStep back to when you said nothing.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"deeedbbcccbdaa\", k = 3 → \"aa\". \"pbbcggttciiippooaais\", k = 2 → \"ps\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
