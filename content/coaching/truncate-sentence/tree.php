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
            'message' => "Read the problem statement above.\nCut point?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Just before the k-th space', 'next' => 's2'],
                ['label' => 'After k characters', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. k counts words, not characters.\nStep back to when you counted characters.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "k equals the word count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Drop the last word', 'next' => 'wrong_b'],
                ['label' => 'Return the whole sentence', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 keeps all five words.\nStep back to when you dropped one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Trailing space?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'None', 'next' => 'success'],
                ['label' => 'Keep one after the last word', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The output is a sentence without trailing spaces.\nStep back to when you added one.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → Hello how are you, What is the solution, chopper is not a tanuki.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
