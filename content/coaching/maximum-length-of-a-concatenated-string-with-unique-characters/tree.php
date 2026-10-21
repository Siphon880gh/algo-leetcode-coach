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
            'message' => "Read the problem statement above.\nKeep \"aa\"?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: it repeats a letter', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. It can never be part of a valid result.\nStep back to when you kept it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Can mask m join cur?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'cur | m != cur', 'next' => 'wrong_b'],
                ['label' => 'cur & m == 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That allows overlapping letters.\nStep back to when you used OR.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When do you update the best?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At every node of the search', 'next' => 'success'],
                ['label' => 'Only after using all strings', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The best subset can skip strings.\nStep back to when you waited for the end.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2ⁿ). [\"un\",\"iq\",\"ue\"] → 4. [\"cha\",\"r\",\"act\",\"ers\"] → 6. [\"abcdefghijklmnopqrstuvwxyz\"] → 26.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
