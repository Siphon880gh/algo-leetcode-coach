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
            'message' => "Read the problem statement above.\nReplacement order matters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: tokens cannot overlap', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The input contains only G, () and (al).\nStep back to when you worried.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "\"()\" becomes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Empty', 'next' => 'wrong_b'],
                ['label' => 'o', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement maps it to o.\nStep back to when you deleted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Scan alternative?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Look at the char after (', 'next' => 'success'],
                ['label' => 'Count parentheses', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The next character tells the token.\nStep back to when you counted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → \"Goal\", \"Gooooal\", \"alGalooG\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
