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
            'message' => "Read the problem statement above.\nDelete from the string while scanning?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: mark, then rebuild once', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Deleting shifts indices and costs O(n²).\nStep back to when you deleted in place.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => ") with an empty stack?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip it and keep it', 'next' => 'wrong_b'],
                ['label' => 'Mark it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It has no match on the left.\nStep back to when you kept it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "( left on the stack at the end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Mark them too', 'next' => 'success'],
                ['label' => 'Keep them', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. They have no match on the right.\nStep back to when you kept them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"lee(t(c)o)de)\" → \"lee(t(c)o)de\". \"a)b(c)d\" → \"ab(c)d\". \"))((\" → \"\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
