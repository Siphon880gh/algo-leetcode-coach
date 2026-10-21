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
            'message' => "Problem: A table Keywords lists topic_id and word pairs (a topic can have several keywords), and a table Posts lists post_id and content. A post belongs to a topic when one of that topic’s keywords appears in its content as a whole word, ignoring case. For each post, return its topic ids as a comma-separated list of distinct ids in ascending order, or the string Ambiguous! when it matches no topic. For instance, content “stop the war and play handball” with keywords WAR (topic 3) and handball (topic 1) → 1,3; “warning” does not match WAR. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nMatch a keyword?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Space-padded LIKE on whole words', 'next' => 's2'],
                ['label' => 'LIKE CONCAT(\'%\', word, \'%\')', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. war would match warning in the constructed example.\nStep back to when you matched substrings.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Case?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compare as stored', 'next' => 'wrong_b'],
                ['label' => 'LOWER on both content and word', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. WAR must match war.\nStep back to when you compared case-sensitively.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Post with no topic?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ambiguous!', 'next' => 'success'],
                ['label' => 'NULL or an empty string', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement asks for the text Ambiguous!.\nStep back to when you left it empty.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed example → 1, 1, 1,3, Ambiguous!.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
