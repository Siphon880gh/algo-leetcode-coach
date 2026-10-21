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
            'message' => "Read the problem statement above.\nAt a b?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'bCount += 1', 'next' => 's2'],
                ['label' => 'res += 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A b is fine until an a follows it.\nStep back to when you charged it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "At an a?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'res + 1 always', 'next' => 'wrong_b'],
                ['label' => 'min(res + 1, bCount)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Deleting earlier b's can be cheaper.\nStep back to when you always deleted the a.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Equivalent view?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Best split: left b\'s + right a\'s', 'next' => 'success'],
                ['label' => 'Count "ba" pairs', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Pairs overlap; one deletion can fix many.\nStep back to when you counted pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
