## Sliding window trie

1. Sort the distinct values.
2. For each y: insert y; remove the smallest values while `2·x < y`.
3. Walk the trie over 20 bits, preferring the opposite bit when its count is positive; update the answer.

Examples → 7, 0, 1020. Checked against testing every pair on 1,500 random arrays.

With n up to 5 · 10^4 there are about 1.25 · 10^9 pairs, too many to test. Removal needs counts on trie nodes, not deleted nodes.

Time: O(n log n + 20n)  
Space: O(20n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
