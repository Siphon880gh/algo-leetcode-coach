## Jump table

1. Sort the indices by nums; pos[i] = sorted position of node i.
2. far[i] by two pointers; up[0] = far, up[j][i] = up[j − 1][up[j − 1][i]].
3. Query (a, b) with a ≤ b after mapping to positions: 0 if a = b; −1 if even the longest jump chain from a stays below b.
4. Otherwise take every power-of-two jump that stays below b, count them, and add 1.

Examples → [1, 1], [1, 2, −1, 1], [0, −1, −1]. Checked against BFS on 300 random graphs.

Answering 1 whenever the nodes are connected: example 2 → [1, 1, −1, 1] instead of [1, 2, −1, 1].

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
