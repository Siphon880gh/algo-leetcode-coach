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
            'message' => "Read the problem statement above.\nThe guess g returned m. Keep which words?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Those with exactly m matches with g', 'next' => 's2'],
                ['label' => 'Those with at least m matches with g', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The secret has exactly m matches with g.\nStep back to when you kept at least m.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which word do you guess next?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always the first candidate', 'next' => 'wrong_b'],
                ['label' => 'One that splits the candidates well, such as the word with the fewest 0-match partners', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A poor choice can leave most words when it returns 0, the most common result.\nStep back to when you took the first word.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The guess returned 6. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop: it is the secret', 'next' => 'success'],
                ['label' => 'Keep filtering', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Six matches means the guess is the secret word.\nStep back to when you kept going.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²) per round to pick a guess, O(n) to filter. The candidate list shrinks fast enough to fit in the allowed guesses.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
