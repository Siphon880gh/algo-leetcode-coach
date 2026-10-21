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
            'message' => "Read the problem statement above.\nWhich characters change?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only A–Z', 'next' => 's2'],
                ['label' => 'Every character', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Digits and punctuation would become other symbols.\nStep back to when you changed everything.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you convert an uppercase letter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'XOR with 32 on every letter', 'next' => 'wrong_b'],
                ['label' => 'Add 32, or OR with 32', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. XOR also turns lowercase letters into uppercase.\nStep back to when you used XOR on every letter.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Do you need a lookup table?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the ASCII offset is enough', 'next' => 'success'],
                ['label' => 'Yes, a table of 26 pairs', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A table works but the fixed offset of 32 is simpler.\nStep back to when you built a table.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"Hello\" → \"hello\". \"LOVELY\" → \"lovely\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
