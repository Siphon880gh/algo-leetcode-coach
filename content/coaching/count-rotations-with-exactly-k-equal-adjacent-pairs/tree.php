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
            'message' => "Read the problem statement above.\nWhich neighbours count toward a rotation's score?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only positions i and i + 1 inside the string', 'next' => 's2'],
                ['label' => 'Also the last and the first character', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. With the wrap pair, every rotation of \"aab\" scores 1, so Example 1 gives 3 instead of 2.\nStep back to when you added the wrap pair.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many rotations do you score?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n − 1, skipping the original string', 'next' => 'wrong_b'],
                ['label' => 'All n, including the original string', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The original \"aab\" is the rotation with an empty prefix moved. Skipping it gives 1 instead of 2.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Score once, then update two pairs per shift. O(n). Examples give 2 and 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
