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
            'message' => "Problem: Design FileSystem with ls(path), mkdir(path), addContentToFile(filePath, content) and readContentFromFile(filePath). ls returns [name] for a file and the sorted names for a directory; mkdir creates missing parents; addContentToFile creates the file if needed and appends. (Restated from memory; limits and examples may differ slightly.)\nHow do you store the file system?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A trie: one node per path component, with children, is_file and content', 'next' => 's2'],
                ['label' => 'A flat map from full path to content', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. ls on a directory needs its children, and a flat map has to scan every path to find them.\nStep back to when you used a flat map.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "ls is called on a file path. What do you return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The node\'s sorted children', 'next' => 'wrong_b'],
                ['label' => 'A list with just the file name', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A file has no children; ls on a file returns [its name].\nStep back to when you listed children.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "addContentToFile on a file that already exists?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Append to its content', 'next' => 'success'],
                ['label' => 'Replace its content', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The contract appends; \"hello\" then \" world\" reads back as \"hello world\".\nStep back to when you replaced.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. A path-part trie, a name for file ls, sorted children for directories, and appends: O(path length) per call.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
