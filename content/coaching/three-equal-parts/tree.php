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
            'message' => "Read the problem statement above.\nThe number of 1s is not divisible by 3. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[−1, −1]', 'next' => 's2'],
                ['label' => 'Try every cut anyway', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Equal values need equal numbers of 1s.\nStep back to when you kept trying.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which part decides how many trailing zeros each value has?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first part', 'next' => 'wrong_b'],
                ['label' => 'The third part: it runs to the end of the array', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The third part cannot shed trailing zeros, so the others must match it.\nStep back to when you used the first part.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "There are no 1s at all. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[0, n − 1]: all three parts are zero', 'next' => 'success'],
                ['label' => '[−1, −1]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Three zero values are equal.\nStep back to when you rejected it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,0,1,0,1] → [0,3]. [1,1,0,1,1] → [−1,−1]. [1,1,0,0,1] → [0,2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
