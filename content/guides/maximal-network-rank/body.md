## All pairs

1. Count `deg[v]`; store roads in a set or matrix.
2. For each pair `a < b`: `deg[a] + deg[b] − [a–b road]`.
3. Return the maximum.

Example 1 → 4. Example 2 → 5. Example 3 (two components) → 5; the pair need not be connected.

O(n²) is fine here. A faster method picks only among the top two degree values, but brute force is simpler. Do not count the shared road twice.

Time: O(n² + E)  
Space: O(n²)

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
