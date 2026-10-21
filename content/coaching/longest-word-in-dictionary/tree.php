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
            'message' => "Read the problem statement above.\nIs a word valid just because it is in the list?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: every prefix must also be in the list', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. \"apple\" needs \"a\", \"ap\", \"app\", \"appl\".\nStep back to when you accepted any listed word.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why sort the words first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'For output order only', 'next' => 'wrong_b'],
                ['label' => 'So each word\'s prefixes are checked before the word', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Lexicographic order puts every prefix before its extensions.\nStep back to when you ignored the order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Two valid words have the same length. Which wins?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The alphabetically smaller', 'next' => 'success'],
                ['label' => 'The one that appears first', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Ties go to the lexicographically smallest.\nStep back to when you used input order.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(Σ len · log n). [\"w\",\"wo\",\"wor\",\"worl\",\"world\"] → \"world\". [\"a\",\"banana\",\"app\",\"appl\",\"ap\",\"apply\",\"apple\"] → \"apple\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
