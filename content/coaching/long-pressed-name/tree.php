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
            'message' => "Read the problem statement above.\ntyped[j] equals name[i]. Match it, or treat it as a long press?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Match it first', 'next' => 's2'],
                ['label' => 'Treat it as a long press', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. For a name like \"aab\" the second a must be matched, not absorbed.\nStep back to when you absorbed it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "typed[j] matches neither name[i] nor typed[j − 1]. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip it', 'next' => 'wrong_b'],
                ['label' => 'Return false', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A stray key is not a long press.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "typed is used up. What else must hold?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i == len(name): the whole name was matched', 'next' => 'success'],
                ['label' => 'Nothing', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Letters of the name may be missing.\nStep back to when you returned true.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). \"alex\", \"aaleex\" → true. \"saeed\", \"ssaaedd\" → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
