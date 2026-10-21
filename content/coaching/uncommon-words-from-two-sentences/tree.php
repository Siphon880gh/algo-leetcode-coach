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
            'message' => "Read the problem statement above.\nCount the sentences separately?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: one map for both sentences', 'next' => 's2'],
                ['label' => 'Yes, then compare sets', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Sets lose repeats, and a word that appears twice in one sentence is not uncommon.\nStep back to when you compared sets.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which words do you keep?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Those that appear in only one sentence', 'next' => 'wrong_b'],
                ['label' => 'Those with count exactly 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A word repeated within one sentence appears in only that sentence but is not uncommon.\nStep back to when you kept it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Does the order of the answer matter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: any order is accepted', 'next' => 'success'],
                ['label' => 'Yes, sorted', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The problem accepts the words in any order.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total length). \"this apple is sweet\", \"this apple is sour\" → [\"sweet\",\"sour\"]. \"apple apple\", \"banana\" → [\"banana\"].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
