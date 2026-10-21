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
            'message' => "Read the problem statement above.\nCompare characters or words?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Words', 'next' => 's2'],
                ['label' => 'Characters', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Frog would match the start of Frogs.\nStep back to when you compared characters.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cap the suffix count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No cap', 'next' => 'wrong_b'],
                ['label' => 'At len(shorter) − prefix', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A word could be matched by both prefix and suffix.\nStep back to when you left it uncapped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Insertion allowed where?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One place: start, middle or end', 'next' => 'success'],
                ['label' => 'Several places', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only one inserted sentence is allowed.\nStep back to when you allowed several.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m + n). Examples → true, false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
