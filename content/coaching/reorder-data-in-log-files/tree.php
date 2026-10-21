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
            'message' => "Read the problem statement above.\nHow do you tell the two kinds apart?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first character after the identifier is a letter or a digit', 'next' => 's2'],
                ['label' => 'The identifier starts with "let" or "dig"', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Identifiers can be any lowercase text.\nStep back to when you read the identifier.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order of the digit logs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sorted by content', 'next' => 'wrong_b'],
                ['label' => 'Unchanged from the input', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Digit logs keep their relative order.\nStep back to when you sorted them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Two letter logs have the same content. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Order by identifier', 'next' => 'success'],
                ['label' => 'Keep input order', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The identifier breaks ties.\nStep back to when you kept input order.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · L log n). [\"dig1 8 1 5 1\",\"let1 art can\",\"dig2 3 6\",\"let2 own kit dig\",\"let3 art zero\"] → [\"let1 art can\",\"let3 art zero\",\"let2 own kit dig\",\"dig1 8 1 5 1\",\"dig2 3 6\"].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
