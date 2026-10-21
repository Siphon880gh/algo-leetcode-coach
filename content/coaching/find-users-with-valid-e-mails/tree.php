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
            'message' => "Read the problem statement above.\nFirst character?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A letter', 'next' => 's2'],
                ['label' => 'Letter, digit, or dot', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. .shapo@leetcode.com is invalid.\nStep back to when you allowed a dot first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The dot in the domain?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Plain .', 'next' => 'wrong_b'],
                ['label' => 'Escape it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. An unescaped dot matches anything.\nStep back to when you left it bare.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Anchors?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '^ and $', 'next' => 'success'],
                ['label' => 'None', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Extra text would sneak through.\nStep back to when you dropped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Keeps Winston, Annabelle, and Sally.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
