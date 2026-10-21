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
            'message' => "Read the problem statement above.\nUse a regex replace with \".\"?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not unescaped: in a regex it matches any character', 'next' => 's2'],
                ['label' => 'Yes, as written', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Every character would be replaced.\nStep back to when you used an unescaped dot.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Edit the string in place?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: build a new string', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The output is longer, and many languages have immutable strings.\nStep back to when you edited in place.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How many characters does each dot become?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3', 'next' => 'success'],
                ['label' => '2', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. \"[.]\" has three characters.\nStep back to when you said 2.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"1.1.1.1\" → \"1[.]1[.]1[.]1\". \"255.100.50.0\" → \"255[.]100[.]50[.]0\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
