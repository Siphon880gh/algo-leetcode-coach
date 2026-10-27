## Pair trie

1. For each word s in order: walk the trie with keys (s[k], s[|s| − 1 − k]) for k = 0 … |s| − 1, adding each node’s end count to the answer.
2. At the last node, end count += 1.

Examples → 4, 2, 0. Checked against testing every pair on 3,000 random word lists.

A trie on characters alone checks only prefixes: ['a', 'ab'] → 1 instead of 0. Testing every pair is up to about 5 · 10^9 pairs here.

Time: O(total length)  
Space: O(total length)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
