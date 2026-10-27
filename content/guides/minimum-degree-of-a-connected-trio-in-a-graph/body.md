## Enumerate trios

1. Adjacency matrix (n ≤ 400) and degrees.
2. For each edge `(u, v)`, for each `w` adjacent to both: `deg(u) + deg(v) + deg(w) − 6`.
3. Minimum over all, or −1.

Example 1 → 3. Example 2 → 0 (trio 1, 3, 4 has no outside edges). Constructed: a path 1–2–3 → −1.

The − 6 removes the three internal edges, each counted at both ends.

Time: O(E · n), at most about n³ / 2  
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
