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
            'message' => "Problem: One table holds text values. Return each text alongside a version where every word starts with an uppercase letter and the rest of the word is lowercase, keeping the spaces as they are. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nUppercase where?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First character and after each space', 'next' => 's2'],
                ['label' => 'First character only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. hello wORLD of sql → Hello world of sql.\nStep back to when you capitalized once.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Other characters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep them as they are', 'next' => 'wrong_b'],
                ['label' => 'Lowercase them', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. hello wORLD of sql → Hello WORLD Of Sql.\nStep back to when you kept the case.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total length). The guide’s check → Hello World Of Sql.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
