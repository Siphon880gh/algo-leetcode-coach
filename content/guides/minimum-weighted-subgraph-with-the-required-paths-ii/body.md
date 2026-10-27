## Steiner tree of three nodes

1. DFS from 0: weighted depth D and binary-lifting ancestors.
2. d(x, y) = D[x] + D[y] − 2 · D[lca(x, y)].
3. Answer (d(src1, src2) + d(src2, dest) + d(src1, dest)) / 2.

Examples → [12, 11], [15]. Checked against trying every edge subset on 200 random trees.

Adding d(src1, dest) and d(src2, dest), so shared edges count twice: example 1 → [16, 17] instead of [12, 11].

Time: O((n + q) log n)  
Space: O(n log n)

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
