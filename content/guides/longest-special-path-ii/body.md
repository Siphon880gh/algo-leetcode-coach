## DFS with top two

1. Keep the path’s prefix distances and, for each value, its last depth on the path.
2. Entering node u at depth h with value v: if v was at depth p, push p into the top two (m1 ≥ m2, start at −1).
3. Start s = m2 + 1. Length = dist[h] − dist[s], nodes = h − s + 1; keep the longest, then the fewest nodes.
4. Recurse into children; on return, restore v’s last depth. Use an explicit stack or a raised recursion limit for 5 · 10⁴ nodes.

Examples → [9, 3], [5, 2]. Checked against testing every ancestor–descendant path on 400 random trees.

Starting after the largest pair start (no repeat allowed): example 1 → [8, 3] instead of [9, 3].

Time: O(n)  
Space: O(n)

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
