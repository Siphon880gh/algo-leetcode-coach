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
            'message' => "Read the problem statement above.\nAllowed relation between consecutive numbers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Strictly greater', 'next' => 's2'],
                ['label' => 'Greater or equal', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. hello world 5 x 5 → false because 5 is not above 5.\nStep back to when you allowed equality.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare numbers as?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Strings', 'next' => 'wrong_b'],
                ['label' => 'Integers', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. As strings 10 < 2, so 2 then 10 would fail.\nStep back to when you compared strings.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Words between numbers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore them', 'next' => 'success'],
                ['label' => 'Reset the previous number', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 1 a 1 must be false; a word does not restart the order.\nStep back to when you reset.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
