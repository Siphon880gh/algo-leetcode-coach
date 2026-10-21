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
            'message' => "Read the problem statement above.\nInsert the words forward?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: reversed, because queries check suffixes', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each query asks if a word ends at the newest letter.\nStep back to when you inserted forward.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How much of the stream do you keep?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Everything', 'next' => 'wrong_b'],
                ['label' => 'The last maxLen letters', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Older letters cannot be part of a match.\nStep back to when you kept everything.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "During the walk you reach a word-end node. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return true right away', 'next' => 'success'],
                ['label' => 'Keep walking to the longest match', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One match is enough.\nStep back to when you kept walking.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(maxLen) per query. words [\"cd\",\"f\",\"kl\"], letters a through l → true at d, f, and l, false elsewhere.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
