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
            'message' => "Read the problem statement above.\nWhat does a comma mean?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Union of alternatives', 'next' => 's2'],
                ['label' => 'Concatenation', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Adjacent parts concatenate; commas separate choices.\nStep back to when you concatenated on a comma.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Two expressions sit side by side. Result?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Their union', 'next' => 'wrong_b'],
                ['label' => 'Every word of the first followed by every word of the second', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Adjacency is a product.\nStep back to when you took the union.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you drop duplicate words?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep sets at every level', 'next' => 'success'],
                ['label' => 'Ignore them', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. \"{a,{a}}\" must give one \"a\".\nStep back to when you ignored duplicates.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. \"{a,b}{c,{d,e}}\" → [\"ac\",\"ad\",\"ae\",\"bc\",\"bd\",\"be\"]. \"{{a,z},a{b,c},{ab,z}}\" → [\"a\",\"ab\",\"ac\",\"z\"].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
