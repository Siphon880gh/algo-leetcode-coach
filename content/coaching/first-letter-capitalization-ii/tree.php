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
            'message' => "Read the problem statement above.\nUppercase where?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Word starts, and after hyphens in letter-hyphen words', 'next' => 's2'],
                ['label' => 'After spaces only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. the QUICK-brown fox → The Quick-brown Fox.\nStep back to when you ignored hyphens.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Other letters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep their case', 'next' => 'wrong_b'],
                ['label' => 'Lowercase', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. the QUICK-brown fox → The QUICK-Brown Fox.\nStep back to when you kept the case.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. The example → The Quick-Brown Fox and the rest as in the guide.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
