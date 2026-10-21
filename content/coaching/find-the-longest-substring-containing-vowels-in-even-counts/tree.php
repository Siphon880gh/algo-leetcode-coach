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
            'message' => "Read the problem statement above.\nStore which index of a mask?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first', 'next' => 's2'],
                ['label' => 'The latest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The first occurrence gives the longest span.\nStep back to when you kept the latest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Initial entry?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nothing', 'next' => 'wrong_b'],
                ['label' => 'mask 0 at index −1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Whole prefixes with even counts would be missed.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Consonants?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave the mask unchanged', 'next' => 'success'],
                ['label' => 'Reset the mask', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only vowels flip bits.\nStep back to when you reset it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"eleetminicoworoep\" → 13. \"leetcodeisgreat\" → 5. \"bcbcbc\" → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
