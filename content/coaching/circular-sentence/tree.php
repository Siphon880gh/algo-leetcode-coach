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
            'message' => "Read the problem statement above.\nWhich joins to check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every space and the wrap-around', 'next' => 's2'],
                ['label' => 'Only the spaces', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The last word must lead back to the first; ab bc → true instead of false.\nStep back to when you skipped the wrap-around.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare letters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignoring case', 'next' => 'wrong_b'],
                ['label' => 'Exactly, case included', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Uppercase and lowercase differ; ab Ba → true instead of false.\nStep back to when you ignored case.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
