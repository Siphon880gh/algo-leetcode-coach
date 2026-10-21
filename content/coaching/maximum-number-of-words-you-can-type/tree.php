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
            'message' => "Read the problem statement above.\nCount what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Whole words with no broken letter', 'next' => 's2'],
                ['label' => 'Typable letters', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The answer counts words.\nStep back to when you counted letters.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Word with one broken letter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Partially counted', 'next' => 'wrong_b'],
                ['label' => 'Not typable', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A word must be typed fully.\nStep back to when you counted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Empty brokenLetters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All words count', 'next' => 'success'],
                ['label' => 'Zero words', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Nothing is broken.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(|text|). Examples → 1, 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
