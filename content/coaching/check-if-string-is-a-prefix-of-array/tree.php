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
            'message' => "Read the problem statement above.\nPrefix may end mid-word?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, it must end at a word boundary', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. s must equal a concatenation of whole words.\nStep back to when you allowed partial words.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order of words?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any k words', 'next' => 'wrong_b'],
                ['label' => 'The first k in order', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only the first k count.\nStep back to when you picked freely.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Stop when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Length ≥ |s|', 'next' => 'success'],
                ['label' => 'After all words', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Longer concatenations can no longer match.\nStep back to when you kept going.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(|s|). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
