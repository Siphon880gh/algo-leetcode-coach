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
            'message' => "Read the problem statement above.\nLetters present?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'End at 0 or t', 'next' => 's2'],
                ['label' => 'Must end at t', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. bccc → 2 instead of 1 (delete the b).\nStep back to when you kept every letter.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Change op?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore it', 'next' => 'wrong_b'],
                ['label' => 'Pass extras to the next letter', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. bcbbaa → 2 instead of 1.\nStep back to when you ignored changes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(26 · max count). Examples → 1, 0, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
