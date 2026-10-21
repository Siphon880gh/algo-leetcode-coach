## Path-only trie

1. Group queries by node.
2. Iterative DFS: on entry insert `u` (counts +1) and answer `max XOR` for each query at `u`; on exit remove `u` (counts −1).
3. Max XOR: from the top bit, prefer the opposite bit if that child's count is positive.

Example 1 → `[2,3,7]`. Example 2 → `[6,14,7]`. Checked against walking each path on random trees.

Counts (not just presence) make deletion safe. 18 bits cover values up to 2 · 10^5. Recursion depth can reach 10^5, so use an explicit stack.

Time: O((n + q) · 18)  
Space: O(n · 18)

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
